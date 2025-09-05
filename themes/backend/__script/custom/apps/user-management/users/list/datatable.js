"use strict";

var KTUsersList = (function () {
    // Define shared variables
    var table = document.getElementById("kt_table_users");
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initUserTable = function () {
        // Set date data order
        const tableRows = table.querySelectorAll("tbody tr");

        tableRows.forEach((row) => {
            const dateRow = row.querySelectorAll("td");
            const lastLogin = dateRow[3].innerText.toLowerCase(); // Get last login time
            let timeCount = 0;
            let timeFormat = "minutes";

            // Determine date & time format -- add more formats when necessary
            if (lastLogin.includes("yesterday")) {
                timeCount = 1;
                timeFormat = "days";
            } else if (lastLogin.includes("mins")) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ""));
                timeFormat = "minutes";
            } else if (lastLogin.includes("hours")) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ""));
                timeFormat = "hours";
            } else if (lastLogin.includes("days")) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ""));
                timeFormat = "days";
            } else if (lastLogin.includes("weeks")) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ""));
                timeFormat = "weeks";
            }

            // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/
            const realDate = moment().subtract(timeCount, timeFormat).format();

            // Insert real date to last login attribute
            dateRow[3].setAttribute("data-order", realDate);

            // Set real date for joined column
            const joinedDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
            dateRow[5].setAttribute("data-order", joinedDate);
        });

        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [],
            stateSave: true,
            select: {
                style: "multi",
                selector: 'td:first-child input[type="checkbox"]',
                className: "row-selected",
            },
            //pageLength: 5,
            lengthChange: true,
            ajax: {
                url: "/backend/User/listDatatable",
            },
            columns: [
                {
                    data: "user_key",
                },
                {
                    data: "user_name",
                },
                {
                    data: "user_group",
                },
                {
                    data: null,
                },
                {
                    data: "user_lastlogin_datetime",
                },
                {
                    data: "user_register_datetitme",
                },
                {
                    data: null,
                },
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" name="key" value="${data}" />
                            </div>`;
                    },
                },
                {
                    targets: 1,
                    //orderable: false,
                    className: "d-flex align-items-center",
                    render: function (data, type, row) {
                        if (row["user_avatar"] != null) {
                            var avatar = `<img src="${row["user_avatar"]}" alt="${row["user_name"]}" class="w-100" />`;
                        } else {
                            var avatar = `<div class="symbol-label fs-3 bg-light-danger text-danger">M</div>`;
                        }
                        return `
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="/backend/user/info?key=${row["user_key"]}">
                                    <div class="symbol-label">
                                        ${avatar}
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="/backend/user/info?key=${row["user_key"]}"
                                    class="text-gray-800 text-hover-primary mb-1">${row["user_name"]}</a>
                                <span>${row["user_email"]}</span>
                            </div>
                            <!--begin::User details-->
                        `;
                    },
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: "text-end",
                    render: function (data, type, row) {
                        return `
                        <a href="#"
                            class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i></a>
                        <!--begin::Menu-->
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="/backend/user/info?key=${row["user_key"]}"
                                    class="menu-link px-3">수정</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-users-table-filter="delete_row">삭제</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        `;
                    },
                },
                {
                    orderable: false,
                    targets: 0,
                }, // Disable ordering on column 0 (checkbox)
                {
                    orderable: false,
                    targets: 6,
                }, // Disable ordering on column 6 (actions)
            ],
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on("draw", function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            KTMenu.createInstances();
        });
    };

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener("keyup", function (e) {
            datatable.search(e.target.value).draw();
        });
    };

    // Filter Datatable
    var handleFilterDatatable = () => {
        // Select filter options
        const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
        const filterButton = filterForm.querySelector('[data-kt-user-table-filter="filter"]');
        const selectOptions = filterForm.querySelectorAll("select");

        // Filter datatable on submit
        filterButton.addEventListener("click", function () {
            var filterString = "";

            // Get filter values
            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== "") {
                    if (index !== 0) {
                        filterString += " ";
                    }

                    // Build filter value options
                    filterString += item.value;
                }
            });

            // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search(filterString).draw();
        });
    };

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-user-table-filter="reset"]');

        // Reset datatable
        resetButton.addEventListener("click", function () {
            // Select filter options
            const filterForm = document.querySelector('[data-kt-user-table-filter="form"]');
            const selectOptions = filterForm.querySelectorAll("select");

            // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
            selectOptions.forEach((select) => {
                $(select).val("").trigger("change");
            });

            // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
            datatable.search("").draw();
        });
    };

    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-users-table-filter="delete_row"]');

        deleteButtons.forEach((d) => {
            // Delete button on click
            d.addEventListener("click", function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest("tr");

                // Get user name
                const userName = parent.querySelectorAll("td")[1].querySelectorAll("a")[1].innerText;

                // Get user name
                //const customerName = parent.querySelectorAll("td")[1].innerText;

                // Get user key
                const userKey = parent.querySelectorAll("td")[0].querySelectorAll("input")[0].value;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "`" + userName + "` 사용자를 삭제하시겠습니까?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "삭제",
                    cancelButtonText: "취소",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then(function (result) {
                    if (result.value) {
                        axios
                            .get("/backend/user/delete/?key=" + userKey)
                            .then(function (response) {
                                if (response) {
                                    Swal.fire({
                                        text: "`" + userName + "` 사용자를 삭제했습니다.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "확인",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        },
                                    }).then(function (result) {
                                        if (result.isConfirmed) {
                                            location.reload(); // reload page
                                        }
                                    });
                                }
                            })
                            .catch(function (error) {
                                Swal.fire({
                                    html: "<p>죄송합니다. 시스템 오류가 감지된 것 같습니다.</p> 다시 시도해 주세요.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "확인",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            });
                    }
                });
            });
        });
    };

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-user-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-user-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-user-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-user-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach((c) => {
            // Checkbox on click event
            c.addEventListener("click", function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener("click", function () {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "선택한 사용자를 삭제하시겠습니까?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "삭제",
                cancelButtonText: "취소",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (result) {
                if (result.value) {
                    Swal.fire({
                        text: "You have deleted all selected customers!.",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        },
                    })
                        .then(function () {
                            // Remove all selected customers
                            checkboxes.forEach((c) => {
                                if (c.checked) {
                                    datatable
                                        .row($(c.closest("tbody tr")))
                                        .remove()
                                        .draw();
                                }
                            });

                            // Remove header checked box
                            const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                            headerCheckbox.checked = false;
                        })
                        .then(function () {
                            toggleToolbars(); // Detect checked checkboxes
                            initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                        });
                }
            });
        });
    };

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach((c) => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add("d-none");
            toolbarSelected.classList.remove("d-none");
        } else {
            toolbarBase.classList.remove("d-none");
            toolbarSelected.classList.add("d-none");
        }
    };

    return {
        // Public functions
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
            handleFilterDatatable();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});

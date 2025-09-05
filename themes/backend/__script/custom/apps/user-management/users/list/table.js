"use strict";

var KTUsersList = (function () {
    // Define shared variables
    var table = document.getElementById("kt_table_users");
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

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
                const userKey = parent.querySelectorAll("td")[0].querySelectorAll("input[type=checkbox]")[0].value;
                const userName = parent.querySelectorAll("td")[1].querySelectorAll("a")[1].innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "``" + userName + "`` 사용자를 삭제하시겠습니까?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "삭제확인",
                    cancelButtonText: "취소",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary",
                    },
                }).then(function (result) {
                    if (result.value) {
                        axios
                            .post("/backend/user/delete", {
                                key: [userKey],
                            })
                            .then(function (response) {
                                if (response) {
                                    Swal.fire({
                                        text: "``" + userName + "`` 사용자가 삭제되었습니다.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "확인",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        },
                                    })
                                        .then(function () {
                                            // Remove current row
                                            //datatable.row($(parent)).remove().draw();
                                            //key = $('input[type="checkbox"][name=user_key]:checked').val()
                                            //console.log([userKey]);
                                            location.reload(); // reload page
                                        })
                                        .then(function () {
                                            // Detect checked checkboxes
                                            toggleToolbars();
                                        });
                                }
                                console.log(response);
                            })
                            .catch(function (error) {
                                Swal.fire({
                                    html: "<p>죄송합니다. 시스템 오류가 감지된 것 같습니다.</p> 다시 시도해 주세요.</p>",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "확인",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                                console.log(error);
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
                confirmButtonText: "삭제확인",
                cancelButtonText: "취소",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary",
                },
            }).then(function (result) {
                if (result.value) {
                    let selectedFruits = [];
                    $('input[type="checkbox"][name=user_key]:checked').each(function () {
                        selectedFruits.push($(this).val());
                    });

                    axios
                        .post("/backend/user/delete", {
                            key: selectedFruits,
                        })
                        .then(function (response) {
                            if (response) {
                                Swal.fire({
                                    text: "선택한 사용자를 모두 삭제했습니다.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "확인",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    },
                                })
                                    .then(function () {
                                        // Remove all selected customers
                                        //console.log(selectedFruits);
                                        location.reload(); // reload page

                                        // Remove header checked box
                                        //const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                                        //headerCheckbox.checked = false;
                                    })
                                    .then(function () {
                                        toggleToolbars(); // Detect checked checkboxes
                                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                                    });
                            }
                            console.log(response);
                        })
                        .catch(function (error) {
                            Swal.fire({
                                html: "<p>죄송합니다. 시스템 오류가 감지된 것 같습니다.</p> 다시 시도해 주세요.</p>",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "확인",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                            console.log(error);
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

            initToggleToolbar();
            handleDeleteRows();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});

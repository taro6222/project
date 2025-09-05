"use strict";

// Class definition
var KTUsersAddUser = (function () {
    // Elements
    const element = document.getElementById("kt_modal_add_user");
    const modal = new bootstrap.Modal(element);
    var form;
    var submitButton;
    var validator;

    // Handle form
    var handleValidation = function (e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(form, {
            fields: {
                user_name: {
                    validators: {
                        notEmpty: {
                            message: "사용자 이름을 입력하십시오.",
                        },
                    },
                },
                user_email: {
                    validators: {
                        regexp: {
                            regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
                            message: "Email 주소 형식이 아닙니다.",
                        },
                        notEmpty: {
                            message: "Email 주소를 입력 하십시오.",
                        },
                    },
                },
                user_passwd: {
                    validators: {
                        notEmpty: {
                            message: "비밀번호를 입력하십시오.",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "", // comment to enable invalid state icons
                    eleValidClass: "", // comment to enable valid state icons
                }),
            },
        });
    };

    var handleSubmitAjax = function (e) {
        // Handle form submit
        submitButton.addEventListener("click", function (e) {
            // Prevent button default action
            e.preventDefault();

            // Validate form
            validator.validate().then(function (status) {
                if (status == "Valid") {
                    // Show loading indication
                    submitButton.setAttribute("data-kt-indicator", "on");

                    // Disable button to avoid multiple click
                    submitButton.disabled = true;

                    // Check axios library docs: https://axios-http.com/docs/intro
                    axios
                        .post(submitButton.closest("form").getAttribute("action"), new FormData(form))
                        .then(function (response) {
                            console.log('-->'+response.data);
                            if (response.data == 1) {
                                form.reset();

                                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    text: "새로운 사용자를 추가했습니다.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "확인",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                }).then(function (result) {
                                    if (result.isConfirmed) {
                                        modal.hide();
                                        location.reload(); // reload page
                                    }
                                });
                            } else {
                                // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    html: "<p>Email 주소가 이미 존재합니다.</p> 확인 후 다시 시도해 주십시오.</p>",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "확인",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    },
                                });
                            }
                        })
                        .catch(function (error) {
                            console.log('-->'+error.response.data);
                            Swal.fire({
                                html: "<p>죄송합니다. 시스템 오류가 감지된 것 같습니다.</p> 다시 시도해 주세요.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "확인",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            });
                        })
                        .then(() => {
                            // Hide loading indication
                            submitButton.removeAttribute("data-kt-indicator");

                            // Enable button
                            submitButton.disabled = false;
                        });
                } else {
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        html: "<p>강조표시된 항목의 안내에 따라 입력하십시오.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "확인",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    // Cancel button handler
    const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
    cancelButton.addEventListener("click", (e) => {
        e.preventDefault();

        Swal.fire({
            text: "입력정보가 사라집니다. 계속하시겠습니까?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "취소확인",
            cancelButtonText: "돌아가기",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
            }
        }).then(function (result) {
            if (result.value) {
                form.reset(); // Reset form
                modal.hide();
            }
        });
    });

    // Close button handler
    const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
    closeButton.addEventListener("click", (e) => {
        e.preventDefault();

        Swal.fire({
            text: "입력정보가 사라집니다. 계속하시겠습니까?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "취소확인",
            cancelButtonText: "돌아가기",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-active-light",
            },
        }).then(function (result) {
            if (result.value) {
                form.reset(); // Reset form
                modal.hide();
            }
        });
    });

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector("#kt_modal_add_user_form");
            submitButton = document.querySelector("#kt_add_user_submit");
            //const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');

            handleValidation();

            if (form.getAttribute("action")) {
                handleSubmitAjax(); // use for ajax submit
            }
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});

/*
("use strict");

// Class definition
var KTUsersAddUser = (function () {
    // Shared variables
    const element = document.getElementById("kt_modal_add_user");
    const form = element.querySelector("#kt_modal_add_user_form");
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddUser = () => {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(form, {
            fields: {
                user_name: {
                    validators: {
                        notEmpty: {
                            message: "Full name is required",
                        },
                    },
                },
                user_email: {
                    validators: {
                        notEmpty: {
                            message: "Valid email address is required",
                        },
                    },
                },
            },

            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap: new FormValidation.plugins.Bootstrap5({
                    rowSelector: ".fv-row",
                    eleInvalidClass: "",
                    eleValidClass: "",
                }),
            },
        });

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
        submitButton.addEventListener("click", (e) => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log("validated!");

                    if (status == "Valid") {
                        // Show loading indication
                        submitButton.setAttribute("data-kt-indicator", "on");

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute("data-kt-indicator");

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                },
                            }).then(function (result) {
                                if (result.isConfirmed) {
                                    modal.hide();
                                }
                            });

                            //form.submit(); // Submit form
                        }, 2000);
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            },
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
        cancelButton.addEventListener("click", (e) => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
        closeButton.addEventListener("click", (e) => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light",
                },
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form
                    modal.hide();
                } else if (result.dismiss === "cancel") {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    });
                }
            });
        });
    };

    return {
        // Public functions
        init: function () {
            initAddUser();
        },
    };
})();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
*/
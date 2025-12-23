<?php /* Tplus 1.1.3-p2 2025-09-06 02:37:30 D:\laragon\www\project\themes\backend\backend.shopReport.shipping.html 000059859 */ ?>
<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper-->
                <div class="d-flex align-items-center pt-1">
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white fw-bold lh-1">
                            <a href="../../demo34/dist/index.html" class="text-white text-hover-primary">
                                <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                            </a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-white fw-bold lh-1">Dashboards</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Toolbar wrapper=-->
                <!--begin::Toolbar wrapper=-->
                <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                    <!--begin::Page title-->
                    <div class="page-title me-5">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                            Welcome back, Amanda
                            <!--begin::Description-->
                            <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Your are #1 seller
                                across market’s Marketing Category</span>
                            <!--end::Description-->
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Page title-->
                    <!--begin::Stats-->
                    <div class="d-flex align-self-center flex-center flex-shrink-0">
                        <a href="#" class="btn btn-flex btn-sm btn-outline btn-active-color-primary btn-custom px-4"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                            <i class="ki-outline ki-plus-square fs-4 me-2"></i>Invite</a>
                        <a href="#" class="btn btn-sm btn-active-color-primary btn-outline btn-custom ms-3 px-4"
                            data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Set Your Target</a>
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Toolbar wrapper=-->
            </div>
            <!--end::Toolbar container=-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Wrapper container-->
    <div class="app-container container-xxl">
        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">
                <!--begin::Content-->
                <div id="kt_app_content" class="app-content flex-column-fluid">
                    <!--begin::Products-->
                    <div class="card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                    <input type="text" data-kt-ecommerce-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-12"
                                        placeholder="Search Report" />
                                </div>
                                <!--end::Search-->
                                <!--begin::Export buttons-->
                                <div id="kt_ecommerce_report_shipping_export" class="d-none"></div>
                                <!--end::Export buttons-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Daterangepicker-->
                                <input class="form-control form-control-solid w-100 mw-250px"
                                    placeholder="Pick date range" id="kt_ecommerce_report_shipping_daterangepicker" />
                                <!--end::Daterangepicker-->
                                <!--begin::Filter-->
                                <div class="w-150px">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" data-control="select2"
                                        data-hide-search="true" data-placeholder="Status"
                                        data-kt-ecommerce-order-filter="status">
                                        <option></option>
                                        <option value="all">All</option>
                                        <option value="Completed">Completed</option>
                                        <option value="In Transit">In Transit</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Filter-->
                                <!--begin::Export dropdown-->
                                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-exit-up fs-2"></i>Export Report</button>
                                <!--begin::Menu-->
                                <div id="kt_ecommerce_report_shipping_export_menu"
                                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="copy">Copy to
                                            clipboard</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="excel">Export as
                                            Excel</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="csv">Export as
                                            CSV</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-ecommerce-export="pdf">Export as
                                            PDF</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Export dropdown-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                id="kt_ecommerce_report_shipping_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Date</th>
                                        <th class="min-w-100px">Shipping Type</th>
                                        <th class="min-w-100px">Shipping ID</th>
                                        <th class="min-w-100px">Status</th>
                                        <th class="text-end min-w-75px">No. Orders</th>
                                        <th class="text-end min-w-100px">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0054963</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end">$504.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0033298</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end">$17.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0062854</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end">$414.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0048873</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$361.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0032545</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end">$361.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0038697</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end">$564.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0042973</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$421.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0045933</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$340.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0059129</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end">$227.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0042851</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$89.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0046321</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end">$70.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0055005</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end">$422.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0059556</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end">$230.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0048001</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end">$416.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0037486</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end">$121.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0055383</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end">$215.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0029991</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">17</td>
                                        <td class="text-end">$548.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0026188</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary">In Transit</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end">$472.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0057872</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end">$421.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0037796</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end">$456.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0052091</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end">$363.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0041762</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">17</td>
                                        <td class="text-end">$58.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0029130</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$296.00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 10, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0057865</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end">$364.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0028412</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$443.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0054123</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$160.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0035011</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary">In Transit</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$528.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0068227</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end">$485.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0047813</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end">$459.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0029439</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end">$366.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0058836</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end">$528.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0031054</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end">$272.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0064788</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end">$572.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0053791</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary">In Transit</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$350.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0066700</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">16</td>
                                        <td class="text-end">$165.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0026698</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end">$197.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0047369</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">19</td>
                                        <td class="text-end">$344.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0067520</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end">$460.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0063930</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end">$413.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0033388</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end">$150.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0032921</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end">$570.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0042083</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end">$409.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0036474</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-primary">In Transit</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end">$204.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0041975</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$569.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0052193</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">19</td>
                                        <td class="text-end">$563.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0046827</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">7</td>
                                        <td class="text-end">$125.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0026012</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end">$595.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0058356</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-warning">Pending</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$310.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0029088</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-danger">Cancelled</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end">$426.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td>Flat Shipping Rate</td>
                                        <td>
                                            <a href="../../demo34/dist/apps/ecommerce/sales/details.html"
                                                class="text-dark text-hover-primary">#SHP-0042210</a>
                                        </td>
                                        <td>
                                            <!--begin::Badges-->
                                            <div class="badge badge-light-success">Completed</div>
                                            <!--end::Badges-->
                                        </td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end">$47.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Products-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Wrapper container-->
</div>
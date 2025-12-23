<?php /* Tplus 1.1.3-p2 2025-09-06 02:37:30 D:\laragon\www\project\themes\backend\backend.shopReport.sales.html 000032016 */ ?>
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
                                <div id="kt_ecommerce_report_sales_export" class="d-none"></div>
                                <!--end::Export buttons-->
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <!--begin::Daterangepicker-->
                                <input class="form-control form-control-solid w-100 mw-250px"
                                    placeholder="Pick date range" id="kt_ecommerce_report_sales_daterangepicker" />
                                <!--end::Daterangepicker-->
                                <!--begin::Export dropdown-->
                                <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-outline ki-exit-up fs-2"></i>Export Report</button>
                                <!--begin::Menu-->
                                <div id="kt_ecommerce_report_sales_export_menu"
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
                                id="kt_ecommerce_report_sales_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Date</th>
                                        <th class="text-end min-w-75px">No. Orders</th>
                                        <th class="text-end min-w-75px">Products Sold</th>
                                        <th class="text-end min-w-75px">Tax</th>
                                        <th class="text-end min-w-100px">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end pe-0">$62.00</td>
                                        <td class="text-end">$411.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">21</td>
                                        <td class="text-end pe-0">$28.00</td>
                                        <td class="text-end">$189.00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 10, 2023</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end pe-0">$9.00</td>
                                        <td class="text-end">$61.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end pe-0">$8.00</td>
                                        <td class="text-end">$52.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end pe-0">$26.00</td>
                                        <td class="text-end">$172.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">5</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">$57.00</td>
                                        <td class="text-end">$381.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end pe-0">$23.00</td>
                                        <td class="text-end">$150.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end pe-0">$84.00</td>
                                        <td class="text-end">$562.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">17</td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end pe-0">$15.00</td>
                                        <td class="text-end">$102.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">$57.00</td>
                                        <td class="text-end">$383.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">$16.00</td>
                                        <td class="text-end">$107.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$77.00</td>
                                        <td class="text-end">$510.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end pe-0">$20.00</td>
                                        <td class="text-end">$134.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$36.00</td>
                                        <td class="text-end">$238.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end pe-0">$48.00</td>
                                        <td class="text-end">$321.00</td>
                                    </tr>
                                    <tr>
                                        <td>May 05, 2023</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">$85.00</td>
                                        <td class="text-end">$564.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">17</td>
                                        <td class="text-end pe-0">$35.00</td>
                                        <td class="text-end">$231.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$26.00</td>
                                        <td class="text-end">$170.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">$3.00</td>
                                        <td class="text-end">$22.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$15.00</td>
                                        <td class="text-end">$103.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end pe-0">16</td>
                                        <td class="text-end pe-0">$26.00</td>
                                        <td class="text-end">$171.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">7</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$20.00</td>
                                        <td class="text-end">$130.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$74.00</td>
                                        <td class="text-end">$492.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">22</td>
                                        <td class="text-end pe-0">$29.00</td>
                                        <td class="text-end">$194.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td class="text-end pe-0">19</td>
                                        <td class="text-end pe-0">22</td>
                                        <td class="text-end pe-0">$59.00</td>
                                        <td class="text-end">$395.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">$55.00</td>
                                        <td class="text-end">$365.00</td>
                                    </tr>
                                    <tr>
                                        <td>Feb 21, 2023</td>
                                        <td class="text-end pe-0">11</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">$47.00</td>
                                        <td class="text-end">$314.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$88.00</td>
                                        <td class="text-end">$585.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td class="text-end pe-0">3</td>
                                        <td class="text-end pe-0">5</td>
                                        <td class="text-end pe-0">$47.00</td>
                                        <td class="text-end">$314.00</td>
                                    </tr>
                                    <tr>
                                        <td>Nov 10, 2023</td>
                                        <td class="text-end pe-0">7</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">$31.00</td>
                                        <td class="text-end">$209.00</td>
                                    </tr>
                                    <tr>
                                        <td>Dec 20, 2023</td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$64.00</td>
                                        <td class="text-end">$428.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">9</td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end pe-0">$66.00</td>
                                        <td class="text-end">$443.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end pe-0">$48.00</td>
                                        <td class="text-end">$317.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end pe-0">$68.00</td>
                                        <td class="text-end">$456.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 20, 2023</td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$42.00</td>
                                        <td class="text-end">$280.00</td>
                                    </tr>
                                    <tr>
                                        <td>Sep 22, 2023</td>
                                        <td class="text-end pe-0">7</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">$21.00</td>
                                        <td class="text-end">$139.00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 10, 2023</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">$47.00</td>
                                        <td class="text-end">$314.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">12</td>
                                        <td class="text-end pe-0">16</td>
                                        <td class="text-end pe-0">$31.00</td>
                                        <td class="text-end">$209.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end pe-0">$12.00</td>
                                        <td class="text-end">$83.00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 10, 2023</td>
                                        <td class="text-end pe-0">10</td>
                                        <td class="text-end pe-0">14</td>
                                        <td class="text-end pe-0">$12.00</td>
                                        <td class="text-end">$78.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">22</td>
                                        <td class="text-end pe-0">$81.00</td>
                                        <td class="text-end">$539.00</td>
                                    </tr>
                                    <tr>
                                        <td>Aug 19, 2023</td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$67.00</td>
                                        <td class="text-end">$445.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">15</td>
                                        <td class="text-end pe-0">19</td>
                                        <td class="text-end pe-0">$53.00</td>
                                        <td class="text-end">$354.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end pe-0">16</td>
                                        <td class="text-end pe-0">$36.00</td>
                                        <td class="text-end">$237.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jun 24, 2023</td>
                                        <td class="text-end pe-0">1</td>
                                        <td class="text-end pe-0">4</td>
                                        <td class="text-end pe-0">$20.00</td>
                                        <td class="text-end">$136.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">16</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">$79.00</td>
                                        <td class="text-end">$528.00</td>
                                    </tr>
                                    <tr>
                                        <td>Oct 25, 2023</td>
                                        <td class="text-end pe-0">2</td>
                                        <td class="text-end pe-0">5</td>
                                        <td class="text-end pe-0">$55.00</td>
                                        <td class="text-end">$365.00</td>
                                    </tr>
                                    <tr>
                                        <td>Apr 15, 2023</td>
                                        <td class="text-end pe-0">13</td>
                                        <td class="text-end pe-0">18</td>
                                        <td class="text-end pe-0">$4.00</td>
                                        <td class="text-end">$29.00</td>
                                    </tr>
                                    <tr>
                                        <td>Jul 25, 2023</td>
                                        <td class="text-end pe-0">6</td>
                                        <td class="text-end pe-0">8</td>
                                        <td class="text-end pe-0">$17.00</td>
                                        <td class="text-end">$116.00</td>
                                    </tr>
                                    <tr>
                                        <td>Mar 10, 2023</td>
                                        <td class="text-end pe-0">20</td>
                                        <td class="text-end pe-0">24</td>
                                        <td class="text-end pe-0">$63.00</td>
                                        <td class="text-end">$423.00</td>
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
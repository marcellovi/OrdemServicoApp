<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistema de O.S</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/vendor/datatables.min.css">
    <link rel="stylesheet" href="assets/styles/css/themes/lite-purple.css">
    <link rel="stylesheet" href="assets/styles/vendor/perfect-scrollbar.css">

    <!-- New added -->
    <link rel="stylesheet" href="assets/styles/vendor/pickadate/classic.css">
    <link rel="stylesheet" href="assets/styles/vendor/pickadate/classic.date.css">

    <style>
        div.scroll {
            max-height: 500px;
            overflow: scroll;
            overflow-x: auto;
        }
    </style>
</head>

<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">

    <!-- Top Menu and Left Side Menu -->
    <!--=============== Left side End ================-->
    @include ('frontend.body.sidemenu');
    <!-- ============ Body content start ============= -->
    <div class="main-content-wrap sidenav-open d-flex flex-column">

        <!-- -->
        <div class="breadcrumb">
            <h1 class="mr-2">Sistema de OS</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- Exemplo Relatirio -->
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs justify-content-end mb-4" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="true">Relatório</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">Editar/Filtar Relatório</a>
                    </li>

                </ul>
                <div class="card">

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
                            <div class="d-sm-flex mb-5" data-view="print">
                                <span class="m-auto"></span>
                                <button class="btn btn-primary mb-sm-0 mb-3 print-invoice">Gerar Relatório</button>
                            </div>
                            <!---===== Print Area =======-->
                            <div id="print-area">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="font-weight-bold">Relatório N.</h4>
                                        <p>#106</p>
                                    </div>
                                    <div class="col-md-6 text-sm-right">
                                        <p><strong>Order status: </strong> Delivered</p>
                                        <p><strong>Order date: </strong> 10 Dec, 2018</p>
                                    </div>
                                </div>
                                <div class="mt-3 mb-4 border-top"></div>
                                <div class="row mb-5">
                                    <div class="col-md-6 mb-3 mb-sm-0">
                                        <h5 class="font-weight-bold">Bill From</h5>
                                        <p>New Age Inc.</p>
                                        <span style="white-space: pre-line">
                                                rodriguez.trent@senger.com
                                                61 Johnson St. Shirley, NY 11967.

                                                +202-555-0170
                                            </span>
                                    </div>
                                    <div class="col-md-6 text-sm-right">
                                        <h5 class="font-weight-bold">Bill To</h5>
                                        <p>UI Lib</p>
                                        <span style="white-space: pre-line">
                                                sales@ui-lib.com
                                                8254 S. Garfield Street. Villa Rica, GA 30180.

                                                +1-202-555-0170
                                            </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-hover mb-4">
                                            <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Product 1</td>
                                                <td>300</td>
                                                <td>2</td>
                                                <td>600</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Product 2</td>
                                                <td>200</td>
                                                <td>3</td>
                                                <td>600</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="invoice-summary">
                                            <p>Sub total: <span>$1200</span></p>
                                            <p>Vat: <span>$120</span></p>
                                            <h5 class="font-weight-bold">Grand Total: <span> $1320</span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--==== / Print Area =====-->
                        </div>
                        <div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
                            <!--==== Edit Area =====-->
                            <div class="d-flex mb-5">
                                <span class="m-auto"></span>
                                <button class="btn btn-primary">Save</button>
                            </div>
                            <form>
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <h4 class="font-weight-bold">Order Info</h4>
                                        <div class="col-sm-4 form-group mb-3 pl-0">
                                            <label for="orderNo">Order Number</label>
                                            <input type="text" class="form-control" id="orderNo" placeholder="Enter order number">
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <label class="d-block text-12 text-muted">Order Status</label>
                                        <div class="pr-0 mb-4">
                                            <label class="radio radio-reverse radio-danger">
                                                <input type="radio" name="orderStatus" value="Pending">
                                                <span>Pending</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio radio-reverse radio-warning">
                                                <input type="radio" name="orderStatus" value="Processing">
                                                <span>Processing</span>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radio radio-reverse radio-success">
                                                <input type="radio" name="orderStatus" value="Delivered">
                                                <span>Delivered</span>
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="order-datepicker">Order Date</label>
                                            <input id="order-datepicker" class="form-control text-right picker__input" placeholder="yyyy-mm-dd" name="dp" readonly="" aria-haspopup="true" aria-expanded="false" aria-readonly="false" aria-owns="order-datepicker_root"><div class="picker" id="order-datepicker_root" aria-hidden="true"><div class="picker__holder" tabindex="-1"><div class="picker__frame"><div class="picker__wrap"><div class="picker__box"><div class="picker__header"><div class="picker__month">September</div><div class="picker__year">2024</div><div class="picker__nav--prev" data-nav="-1" role="button" aria-controls="order-datepicker_table" title="Previous month"> </div><div class="picker__nav--next" data-nav="1" role="button" aria-controls="order-datepicker_table" title="Next month"> </div></div><table class="picker__table" id="order-datepicker_table" role="grid" aria-controls="order-datepicker" aria-readonly="true"><thead><tr><th class="picker__weekday" scope="col" title="Sunday">Sun</th><th class="picker__weekday" scope="col" title="Monday">Mon</th><th class="picker__weekday" scope="col" title="Tuesday">Tue</th><th class="picker__weekday" scope="col" title="Wednesday">Wed</th><th class="picker__weekday" scope="col" title="Thursday">Thu</th><th class="picker__weekday" scope="col" title="Friday">Fri</th><th class="picker__weekday" scope="col" title="Saturday">Sat</th></tr></thead><tbody><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725166800000" role="gridcell" aria-label="1 September, 2024">1</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725253200000" role="gridcell" aria-label="2 September, 2024">2</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725339600000" role="gridcell" aria-label="3 September, 2024">3</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725426000000" role="gridcell" aria-label="4 September, 2024">4</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725512400000" role="gridcell" aria-label="5 September, 2024">5</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725598800000" role="gridcell" aria-label="6 September, 2024">6</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725685200000" role="gridcell" aria-label="7 September, 2024">7</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725771600000" role="gridcell" aria-label="8 September, 2024">8</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725858000000" role="gridcell" aria-label="9 September, 2024">9</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1725944400000" role="gridcell" aria-label="10 September, 2024">10</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726030800000" role="gridcell" aria-label="11 September, 2024">11</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726117200000" role="gridcell" aria-label="12 September, 2024">12</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726203600000" role="gridcell" aria-label="13 September, 2024">13</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726290000000" role="gridcell" aria-label="14 September, 2024">14</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726376400000" role="gridcell" aria-label="15 September, 2024">15</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726462800000" role="gridcell" aria-label="16 September, 2024">16</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726549200000" role="gridcell" aria-label="17 September, 2024">17</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726635600000" role="gridcell" aria-label="18 September, 2024">18</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726722000000" role="gridcell" aria-label="19 September, 2024">19</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726808400000" role="gridcell" aria-label="20 September, 2024">20</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726894800000" role="gridcell" aria-label="21 September, 2024">21</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1726981200000" role="gridcell" aria-label="22 September, 2024">22</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727067600000" role="gridcell" aria-label="23 September, 2024">23</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727154000000" role="gridcell" aria-label="24 September, 2024">24</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727240400000" role="gridcell" aria-label="25 September, 2024">25</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727326800000" role="gridcell" aria-label="26 September, 2024">26</div></td><td role="presentation"><div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted" data-pick="1727413200000" role="gridcell" aria-label="27 September, 2024" aria-activedescendant="true">27</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727499600000" role="gridcell" aria-label="28 September, 2024">28</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727586000000" role="gridcell" aria-label="29 September, 2024">29</div></td><td role="presentation"><div class="picker__day picker__day--infocus" data-pick="1727672400000" role="gridcell" aria-label="30 September, 2024">30</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1727758800000" role="gridcell" aria-label="1 October, 2024">1</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1727845200000" role="gridcell" aria-label="2 October, 2024">2</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1727931600000" role="gridcell" aria-label="3 October, 2024">3</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728018000000" role="gridcell" aria-label="4 October, 2024">4</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728104400000" role="gridcell" aria-label="5 October, 2024">5</div></td></tr><tr><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728190800000" role="gridcell" aria-label="6 October, 2024">6</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728277200000" role="gridcell" aria-label="7 October, 2024">7</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728363600000" role="gridcell" aria-label="8 October, 2024">8</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728450000000" role="gridcell" aria-label="9 October, 2024">9</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728536400000" role="gridcell" aria-label="10 October, 2024">10</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728622800000" role="gridcell" aria-label="11 October, 2024">11</div></td><td role="presentation"><div class="picker__day picker__day--outfocus" data-pick="1728709200000" role="gridcell" aria-label="12 October, 2024">12</div></td></tr></tbody></table><div class="picker__footer"><button class="picker__button--today" type="button" data-pick="1727413200000" disabled="" aria-controls="order-datepicker">Today</button><button class="picker__button--clear" type="button" data-clear="1" disabled="" aria-controls="order-datepicker">Clear</button><button class="picker__button--close" type="button" data-close="true" disabled="" aria-controls="order-datepicker">Close</button></div></div></div></div></div></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3 mb-4 border-top"></div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold">Bill From</h5>
                                        <div class="col-md-10 form-group mb-3 pl-0">
                                            <input type="text" class="form-control" id="billFrom3" placeholder="Bill From">
                                        </div>
                                        <div class="col-md-10 form-group mb-3 pl-0">
                                            <textarea class="form-control" placeholder="Bill From Address"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6 text-right">
                                        <h5 class="font-weight-bold">Bill To</h5>
                                        <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                            <input type="text" class="form-control text-right" id="billFrom2" placeholder="Bill From">
                                        </div>
                                        <div class="col-md-10 offset-md-2 form-group mb-3 pr-0">
                                            <textarea class="form-control text-right" placeholder="Bill From Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-hover mb-3">
                                            <thead class="bg-gray-300">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Unit Price</th>
                                                <th scope="col">Unit</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>
                                                    <input value="Product 1" type="text" class="form-control" placeholder="Item Name">
                                                </td>
                                                <td>
                                                    <input value="300" type="number" class="form-control" placeholder="Unit Price">
                                                </td>
                                                <td>
                                                    <input value="2" type="number" class="form-control" placeholder="Unit">
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>
                                                    <input value="Product 1" type="text" class="form-control" placeholder="Item Name">
                                                </td>
                                                <td>
                                                    <input value="300" type="number" class="form-control" placeholder="Unit Price">
                                                </td>
                                                <td>
                                                    <input value="2" type="number" class="form-control" placeholder="Unit">
                                                </td>
                                                <td>600</td>
                                                <td>
                                                    <button class="btn btn-outline-secondary float-right">Delete</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <button class="btn btn-primary float-right mb-4">Add Item</button>
                                    </div>

                                    <div class="col-md-12">

                                        <div class="invoice-summary invoice-summary-input float-right">
                                            <p>Sub total: <span>$1200</span></p>
                                            <p class="d-flex align-items-center">Vat(%):<span>
                                                        <input type="text" class="form-control small-input" value="10">$120</span>
                                            </p>
                                            <h5 class="font-weight-bold d-flex align-items-center">Grand Total:
                                                <span>
                                                        <input type="text" class="form-control small-input" value="$">
                                                        $1320
                                                    </span>
                                            </h5>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!--==== / Edit Area =====-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end of row-->
    </div>
    <!-- ============ Body content End ============= -->
</div>
<!--=============== End app-admin-wrap ================-->

<!-- ============ Search UI Start ============= -->
<div class="search-ui">
    <div class="search-header">
        <img src="./assets/images/er_profile.png" alt="" class="logo">
        <button class="search-close btn btn-icon bg-transparent float-right mt-2">
            <i class="i-Close-Window text-22 text-muted"></i>
        </button>
    </div>

    <input type="text" placeholder="Type here" class="search-input" autofocus>

    <div class="search-title">
        <span class="text-muted">Search results</span>
    </div>

    <div class="search-results list-horizontal">
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-1.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-danger">Sale</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-2.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-3.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
        <div class="list-item col-md-12 p-0">
            <div class="card o-hidden flex-row mb-4 d-flex">
                <div class="list-thumb d-flex">
                    <!-- TUMBNAIL -->
                    <img src="./assets/images/products/headphone-4.jpg" alt="">
                </div>
                <div class="flex-grow-1 pl-2 d-flex">
                    <div class="card-body align-self-center d-flex flex-column justify-content-between align-items-lg-center flex-lg-row">
                        <!-- OTHER DATA -->
                        <a href="" class="w-40 w-sm-100">
                            <div class="item-title">Headphone 1</div>
                        </a>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">Gadget</p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100">
                            $300
                            <del class="text-secondary">$400</del>
                        </p>
                        <p class="m-0 text-muted text-small w-15 w-sm-100 d-none d-lg-block item-badges">
                            <span class="badge badge-primary">New</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- PAGINATION CONTROL -->
    <div class="col-md-12 mt-5 text-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination d-inline-flex">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- ============ Search UI End ============= -->

<script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
<script src="assets/js/vendor/perfect-scrollbar.min.js"></script>
<script src="assets/js/vendor/echarts.min.js"></script>
<script src="assets/js/vendor/datatables.min.js"></script>

<script src="assets/js/es5/echart.options.min.js"></script>
<script src="assets/js/es5/dashboard.v2.script.min.js"></script>

<script src="assets/js/es5/script.min.js"></script>
<script src="assets/js/es5/sidebar.large.script.min.js"></script>

<script src="assets/js/vendor/apexcharts.min.js"></script>
<script src="assets/js/vendor/echarts.min.js"></script>
<script src="assets/js/es5/echart.options.min.js"></script>





<!-- New Added -->
<script src="assets/js/invoice.script.js"></script>
<script src="assets/js/vendor/pickadate/picker.js"></script>
<script src="assets/js/vendor/pickadate/picker.date.js"></script>
</body>

</html>

@extends('layouts.app')
@section('section')
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Earnings -->
        <!-- ============================================================== -->
        <div class="row">


            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="card-content center-align">
                        <div>
                            <span class="blue-text display-6"><i class="ti-bar-chart-alt"></i></span>
                        </div>
                        <div>
                            <h4>62,600</h4>
                            <h6 class="blue-text font-medium m-b-0">Top Sales</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="card-content center-align">
                        <div>
                            <span class="cyan-text display-6"><i class="ti-receipt"></i></span>
                        </div>
                        <div>
                            <h4>12,270</h4>
                            <h6 class="cyan-text font-medium m-b-0">Top Feeds</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="card-content center-align">
                        <div>
                            <span class="red-text display-6"><i class="ti-map-alt"></i></span>
                        </div>
                        <div class="">
                            <h4>21,090</h4>
                            <h6 class="red-text font-medium m-b-0">Top Locations</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="card-content center-align">
                        <div>
                            <span class="yellow-text text-darken-2 display-6"><i class="ti-check-box"></i></span>
                        </div>
                        <div>
                            <h4>20,120</h4>
                            <h6 class="yellow-text text-darken-2 font-medium m-b-0">Top Activity Pages</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Notifications, Chart -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- column -->
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="card-title">Monthly Overview</h5>
                                <h6 class="card-subtitle">Overview of latest Month</h6>
                            </div>
                            <div class="ml-auto">
                                <div class="input-field dl support-select">
                                    <select>
                                        <option value="0" selected>10 Mar- 10 Apr</option>
                                        <option value="1">20 Mar- 10 Apr</option>
                                        <option value="2">10 Mar- 20 Apr</option>
                                        <option value="3">11 Mar- 10 Apr</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Sales Summery -->
                        <div class="p-t-20">
                            <div class="row">
                                <!-- column -->
                                <div class="col s12">
                                    <div id="profit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l4">
                <div id="current-month" class="">
                    <div class="card e-campaign c3-border ">
                        <div class="p-15 warning-gradient">
                            <h5 class="card-title white-text">Revanue</h5>
                            <h6 class="card-subtitle white-text">Today</h6>
                            <div class="center-align">
                                <div style="height:219px; width:100%;" class="m-t-20 rate"></div>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 m6 center-align">
                                    <span>Goal</span>
                                    <h5 class="font-medium m-b-0">$4769.08</h5>
                                </div>
                                <div class="col s12 m6 center-align">
                                    <span>Current</span>
                                    <h5 class="font-medium m-b-0">$3280.98</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l8">
                <!-- ============================================================== -->
                <!-- Product Sales -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="p-15 p-b-0 info-gradient">
                                <div class="d-flex">
                                    <div>
                                        <h5 class="card-title white-text">Product Earnings</h5>
                                        <h6 class="card-subtitle white-text m-b-0">Today</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <h3 class="white-text m-b-0">$6,890.68</h3>
                                    </div>
                                </div>
                                <div id="day">
                                    <div class="product-earning" style="height:250px; width:100%;"></div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="m-r-10"><a class="btn-floating btn light-blue accent-2">EA</a></div>
                                            <div>
                                                <span class="">Product A</span>
                                                <h5 class="font-16 font-medium">$16,122.08</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="m-r-10"><a class="btn-floating btn light-blue accent-2">MP</a></div>
                                            <div>
                                                <span class="">Product B</span>
                                                <h5 class="font-16 font-medium">$26,122.08</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="m-r-10"><a class="btn-floating btn light-blue accent-2">AW</a></div>
                                            <div>
                                                <span class="">Product C</span>
                                                <h5 class="font-16 font-medium">$45,122.08</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Orders -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col s12 l8">
                <div class="card">
                    <div class="card-content">
                        <!-- title -->
                        <div class="d-flex align-items-center">
                            <div>
                                <h5 class="card-title">Projects of the Month</h5>
                                <h6 class="card-subtitle">Overview of Latest Month</h6>
                            </div>
                            <div class="ml-auto">
                                <div class="input-field dl support-select">
                                    <select>
                                        <option value="0" selected>March</option>
                                        <option value="1">April</option>
                                        <option value="2">May</option>
                                        <option value="3">June</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- title -->
                        <div class="table-responsive scrollable p-o" style="height:400px;">
                            <table class="">
                                <thead>
                                    <tr>
                                        <th>Products</th>
                                        <th>Customers</th>
                                        <th>Status</th>
                                        <th>Invoice</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img
                                                        src="{{ asset('../../assets/images/product/chair.png') }}"
                                                        alt="user" class="circle" width="45" />
                                                </div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Orange Shoes</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Rotating Chair</td>
                                        <td><i class="fa fa-circle orange-text tooltipped" data-tooltip="In Progress"></i>
                                        </td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img
                                                        src="{{ asset('../../assets/images/product/chair2.png') }}"
                                                        alt="user" class="circle" width="45" />
                                                </div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Red Sandle</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Dummy Product</td>
                                        <td><i class="fa fa-circle teal-text text-accent-4 tooltipped"
                                                data-tooltip="Active"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img
                                                        src="{{ asset('../../assets/images/product/chair3.png') }}"
                                                        alt="user" class="circle" width="45" />
                                                </div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Gourgeous Purse</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Comfortable Chair</td>
                                        <td><i class="fa fa-circle teal-text text-accent-4 tooltipped"
                                                data-tooltip="Active"></i></td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex no-block align-items-center">
                                                <div class="m-r-10"><img
                                                        src="{{ asset('../../assets/images/product/chair4.png') }}"
                                                        alt="user" class="circle" width="45" />
                                                </div>
                                                <div class="">
                                                    <h5 class="m-b-0 font-16 font-medium">Puma T-shirt</h5>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Wooden Chair</td>
                                        <td><i class="fa fa-circle orange-text tooltipped" data-tooltip="In Progress"></i>
                                        </td>
                                        <td>35</td>
                                        <td class="blue-grey-text  text-darken-4 font-medium">$96K</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 l4">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Order Stats</h5>
                        <h6 class="card-subtitle">Overview of orders</h6>
                        <div class="m-t-30" id="visitor" style="height:280px; width:100%"></div>
                    </div>
                    <div class="card-action">
                        <div class="row">
                            <div class="col s4">
                                <i class="fa fa-circle light-blue-text"></i>
                                <h4 class="m-b-0 font-medium">5489</h4>
                                <span>Success</span>
                            </div>
                            <div class="col s4">
                                <i class="fa fa-circle blue-text text-accent-4"></i>
                                <h4 class="m-b-0 font-medium">954</h4>
                                <span>Pending</span>
                            </div>
                            <div class="col s4">
                                <i class="fa fa-circle orange-text"></i>
                                <h4 class="m-b-0 font-medium">736</h4>
                                <span>Failed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Review -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="row">
                        <div class="col s12 l4">
                            <div class="card-content">
                                <h5 class="card-title">Reviews</h5>
                                <h6 class="card-subtitle">Overview of Review</h6>
                                <h3 class="font-medium m-t-40 m-b-0">25426</h3>
                                <span>This month we got 346 New Reviews</span>
                                <div class="image-box m-t-30 m-b-30">
                                    <a href="#" class="tooltipped m-r-10" data-position="top" data-delay="50"
                                        data-tooltip="Name"><img src="{{ asset('../../assets/images/users/1.jpg') }}"
                                            class="circle" width="45" alt="user"></a>
                                    <a href="#" class="tooltipped m-r-10" data-position="top" data-delay="50"
                                        data-tooltip="Name"><img src="{{ asset('../../assets/images/users/2.jpg') }}"
                                            class="circle" width="45" alt="user"></a>
                                    <a href="#" class="tooltipped m-r-10" data-position="top" data-delay="50"
                                        data-tooltip="Name"><img src="{{ asset('../../assets/images/users/3.jpg') }}"
                                            class="circle" width="45" alt="user"></a>
                                    <a href="#" class="tooltipped m-r-10" data-position="top" data-delay="50"
                                        data-tooltip="Name"><img src="{{ asset('../../assets/images/users/4.jpg') }}"
                                            class="circle" width="45" alt="user"></a>
                                </div>
                                <a href="#" class="blue accent-4 btn-large">Checkout All Reviews</a>
                            </div>
                        </div>
                        <div class="col s12 l8 b-l">
                            <div class="card-content">
                                <ul>
                                    <li class="m-t-30">
                                        <div class="d-flex no-block align-items-center">
                                            <i class="material-icons display-5">insert_emoticon</i>
                                            <div class="m-l-10">
                                                <h6 class="m-b-0 font-medium">Positive Reviews</h6><span>25547
                                                    Reviews</span>
                                            </div>
                                        </div>
                                        <div class="progress grey lighten-3 m-t-10">
                                            <div class="determinate green" style="width: 70%"></div>
                                        </div>
                                    </li>
                                    <li class="m-t-40">
                                        <div class="d-flex no-block align-items-center">
                                            <i class="material-icons display-5">mood_bad</i>
                                            <div class="m-l-10">
                                                <h6 class="m-b-0 font-medium">Negative Reviews</h6><span>5547
                                                    Reviews</span>
                                            </div>
                                        </div>
                                        <div class="progress grey lighten-3 m-t-10">
                                            <div class="determinate orange" style="width: 40%"></div>
                                        </div>
                                    </li>
                                    <li class="m-t-40 m-b-40">
                                        <div class="d-flex no-block align-items-center">
                                            <i class="material-icons display-5">sentiment_neutral</i>
                                            <div class="m-l-10">
                                                <h6 class="m-b-0 font-medium">Nutral Reviews</h6><span>547
                                                    Reviews</span>
                                            </div>
                                        </div>
                                        <div class="progress grey lighten-3 m-t-10">
                                            <div class="determinate blue accent-4" style="width: 10%"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

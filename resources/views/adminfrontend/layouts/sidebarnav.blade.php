<?php
    use App\Models\Settings;
?>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="{{url('admin/dashboard')}}">
                @php
                    $shopName = Settings::all()->first();
                @endphp
                <h3 class="text-primary fw-bold">{{$shopName->website_name}}</h3>
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item {{Request::is('admin/dashboard')? 'active':''}}">
                    <a href="{{url('admin/dashboard')}}">
                        <span class="icon">
                            <span class="material-icons-round">dashboard</span>
                        </span>
                        <span class="text"><strong>Dashboard</strong></span>
                    </a>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children {{Request::is('admin/product-detail*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_1"
                        aria-controls="ddmenu_1"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">local_mall</span>
                        </span>
                        <span class="text"><strong>Products</strong></span>
                    </a>
                    <ul id="ddmenu_1" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/product-detail-list/show=10/by-name=asc')}}"
                                class="{{Request::is('admin/product-detail-list')? 'active':''}}">
                                Product List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/product-detail-add')}}"
                                class="{{Request::is('admin/product-detail-add')? 'active':''}}">
                                Product Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children {{Request::is('admin/order*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_2"
                        aria-controls="ddmenu_2"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">shopping_cart</span>
                        </span>
                        <span class="text"><strong>Orders</strong></span>
                    </a>
                    <ul id="ddmenu_2" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/order-list/show=10/by-code=desc')}}"
                                class="{{Request::is('admin/order-list')? 'active':''}}">
                                Orders List
                            </a>
                        </li>
                        <!--
                        <li>
                            <a  href="{{url('admin/order-status-list')}}"
                                class="{{Request::is('admin/order-status-list')? 'active':''}}">
                                Order Statuses Option
                            </a>
                        </li>
                        -->
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children  {{Request::is('admin/product-group*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_3"
                        aria-controls="ddmenu_3"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">format_list_bulleted</span>
                        </span>
                        <span class="text"><strong>Groups</strong></span>
                    </a>
                    <ul id="ddmenu_3" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/product-group-list')}}"
                                class="{{Request::is('admin/product-group-list')? 'active':''}}">
                                Groups List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/product-group-add')}}"
                                class="{{Request::is('admin/product-group-add')? 'active':''}}">
                                Groups Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children   {{Request::is('admin/product-category*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_4"
                        aria-controls="ddmenu_4"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">category</span>
                        </span>
                        <span class="text"><strong>Categories</strong></span>
                    </a>
                    <ul id="ddmenu_4" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/product-category-list')}}"
                                class="{{Request::is('admin/product-category-list')? 'active':''}}">
                                Categories List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/product-category-add')}}"
                                class="{{Request::is('admin/product-category-add')? 'active':''}}">
                                Categories Add</a>
                        </li>
                        <li>
                            <a  href="{{url('admin/product-category-sub-list')}}"
                                class="{{Request::is('admin/product-category-sub-list')? 'active':''}}">
                                Subcategories List
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children   {{Request::is('admin/product-size*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_5"
                        aria-controls="ddmenu_5"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">straighten</span>
                        </span>
                        <span class="text"><strong>Sizes</strong></span>
                    </a>
                    <ul id="ddmenu_5" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/product-size-list')}}"
                                class="{{Request::is('admin/product-size-list')? 'active':''}}">
                                Sizes List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/product-size-add')}}"
                                class="{{Request::is('admin/product-size-add')? 'active':''}}">
                                Sizes Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children   {{Request::is('admin/delivery*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_6"
                        aria-controls="ddmenu_6"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">local_shipping</span>
                        </span>
                        <span class="text"><strong>Delivery Methods</strong></span>
                    </a>
                    <ul id="ddmenu_6" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/delivery-list')}}"
                                class="{{Request::is('admin/delivery-list')? 'active':''}}">
                                Deliveries Methods List
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{url('admin/delivery-add')}}"
                                class="{{Request::is('admin/delivery-add')? 'active':''}}"
                                >
                                Delivery  Methods Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children   {{Request::is('admin/payment*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_7"
                        aria-controls="ddmenu_7"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">payments</span>
                        </span>
                        <span class="text"><strong>Payment Methods</strong></span>
                    </a>
                    <ul id="ddmenu_7" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/payment-list')}}"
                                class="{{Request::is('admin/payment-list')? 'active':''}}">
                                Payment Methods List
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{url('admin/payment-add')}}"
                                class="{{Request::is('admin/payment-add')? 'active':''}}"
                                >
                                Payment Methods Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children  {{Request::is('admin/coupon*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_8"
                        aria-controls="ddmenu_8"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">card_giftcard</span>
                        </span>
                        <span class="text"><strong>Coupons</strong></span>
                    </a>
                    <ul id="ddmenu_8" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/coupon-list')}}"
                                class="{{Request::is('admin/coupon-list')? 'active':''}}">
                                Coupon List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/coupon-add')}}"
                                class="{{Request::is('admin/coupon-add')? 'active':''}}">
                                Coupon Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children {{Request::is('admin/customer*')? 'active':''}}"
                    >
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_9"
                        aria-controls="ddmenu_9"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                        >
                        <span class="icon">
                            <span class="material-icons-round">group</span>
                        </span>
                        <span class="text"><strong>Customers</strong></span>
                    </a>
                    <ul id="ddmenu_9" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/customer-member-list')}}"
                                class="{{Request::is('admin/customer-member-list')? 'active':''}}">
                                Members List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/customer-list')}}"
                                class="{{Request::is('admin/customer-list')? 'active':''}}">
                                Customers List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/customer-subscriber-list')}}"
                                class="{{Request::is('admin/customer-subscriber-list')? 'active':''}}">
                                Subscribers List
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children {{Request::is('admin/news*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_10"
                        aria-controls="ddmenu_10"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="icon">
                            <span class="material-icons-round">description</span>
                        </span>
                        <span class="text"><strong>News</strong></span>
                    </a>
                    <ul id="ddmenu_10" class="collapse dropdown-nav">
                        <li>
                            <a  href="{{url('admin/news-list')}}"
                                {{Request::is('admin/news-list')? 'active':''}}>
                                News & Introducing List
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/news-add')}}"
                                {{Request::is('admin/news-add')? 'active':''}}>
                                News & Introducing Add
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <li class="nav-item nav-item-has-children {{Request::is('admin/general-setting*')? 'active':''}}">
                    <a
                        href="#0"
                        class="collapsed"
                        data-bs-toggle="collapse"
                        data-bs-target="#ddmenu_11"
                        aria-controls="ddmenu_11"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="icon">
                            <span class="material-icons-round">settings</span>
                        </span>
                        <span class="text"><strong>Settings</strong></span>
                    </a>
                    <ul id="ddmenu_11" class="collapse dropdown-nav">
                        <li>
                            <a href="{{url('admin/general-setting')}}">
                                General Setting
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/general-setting-edit')}}"
                                {{Request::is('admin/general-setting-edit')? 'active':''}}>
                                General Setting Edit
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/general-layout')}}"
                                {{Request::is('admin/general-layout')? 'active':''}}>
                                Layout View
                            </a>
                        </li>
                        <li>
                            <a  href="{{url('admin/contact-list')}}"
                                {{Request::is('admin/contact-list')? 'active':''}}>
                                Contacts
                            </a>
                        </li>
                    </ul>
                </li>
                <!---------------------------------------------------------->
                <span class="divider"><hr /></span>
            </ul>
        </nav>
        <div class="promo-box">
            <a  href="{{url('admin/logout')}}"
                class="main-btn primary-btn btn-hover">
                Log Out
            </a>
        </div>
    </aside>
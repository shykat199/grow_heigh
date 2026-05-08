<div class="sidenav-menu">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="logo">
        <span class="logo logo-light">
            <span class="logo-lg"><img src="{{asset('assets/images/logo.png')}}" alt="logo" /></span>
            <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" /></span>
        </span>

        <span class="logo logo-dark">
            <span class="logo-lg"><img src="{{asset('assets/images/logo-black.png')}}" alt="dark logo" /></span>
            <span class="logo-sm"><img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" /></span>
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button class="button-on-hover">
        <span class="btn-on-hover-icon"></span>
    </button>

    <!-- Full Sidebar Menu Close Button -->
    <button class="button-close-offcanvas">
        <i class="ti ti-menu-4 align-middle"></i>
    </button>

    <div class="scrollbar" data-simplebar="">
        <div id="user-profile-settings" class="sidenav-user" style="background: url({{asset('assets/images/user-bg-pattern.svg')}})">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="#!" class="link-reset">
                        <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle mb-2 avatar-md" />
                        <span class="sidenav-user-name fw-bold">David Dev</span>
                        <span class="fs-12 fw-semibold" data-lang="user-role">Art Director</span>
                    </a>
                </div>
                <div>
                    <a class="dropdown-toggle drop-arrow-none link-reset sidenav-user-set-icon" data-bs-toggle="dropdown" data-bs-offset="0,12" href="#!" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-settings fs-24 align-middle ms-1"></i>
                    </a>

                    <div class="dropdown-menu">
                        <!-- Header -->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome back!</h6>
                        </div>

                        <!-- My Profile -->
                        <a href="#!" class="dropdown-item">
                            <i class="ti ti-user-circle me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Profile</span>
                        </a>

                        <!-- Logout -->
                        <a href="javascript:void(0);" class="dropdown-item text-danger fw-semibold">
                            <i class="ti ti-logout me-1 fs-lg align-middle"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!--- Sidenav Menu -->
        <div id="sidenav-menu">
            <ul class="side-nav">
                <li class="side-nav-item">
                    <a href="{{route('admin.dashboard')}}" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                        <span class="menu-text" data-lang="dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#ecommerce" aria-expanded="false" aria-controls="ecommerce" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-basket"></i></span>
                        <span class="menu-text" data-lang="ecommerce">Ecommerce</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="ecommerce">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#products" aria-expanded="false" aria-controls="products" class="side-nav-link">
                                    <span class="menu-text" data-lang="products">Products</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="products">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-products.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-products">Products</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-products-grid.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-products-grid">Products Grid</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-product-details.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-product-details">Product Details</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-product-add.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-product-add">Add Product</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-ecommerce-categories.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-ecommerce-categories">Categories</span>
                                </a>
                            </li>
                            <li class="side-nav-item active">
                                <a href="apps-ecommerce-customers.html" class="side-nav-link active">
                                    <span class="menu-text" data-lang="apps-ecommerce-customers">Customers</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders" class="side-nav-link">
                                    <span class="menu-text" data-lang="orders">Orders</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="orders">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-orders.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-orders">Orders</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-order-details.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-order-details">Order Details</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-ecommerce-order-add.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-ecommerce-order-add">Add/Edit Order</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#invoice" aria-expanded="false" aria-controls="invoice" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-invoice"></i></span>
                        <span class="menu-text" data-lang="invoice">Invoice</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="invoice">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="apps-invoice-list.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-invoice-list">Invoices</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-invoice-details.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-invoice-details">Single Invoice</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-invoice-create.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-invoice-create">New Invoice</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#finance" aria-expanded="false" aria-controls="finance" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-wallet"></i></span>
                        <span class="menu-text" data-lang="finance">Finance</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="finance">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a data-bs-toggle="collapse" href="#expenses" aria-expanded="false" aria-controls="expenses" class="side-nav-link">
                                    <span class="menu-text" data-lang="expenses">Expenses</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="expenses">
                                    <ul class="sub-menu">
                                        <li class="side-nav-item">
                                            <a href="apps-finance-expenses.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-finance-expenses">Expenses</span>
                                            </a>
                                        </li>
                                        <li class="side-nav-item">
                                            <a href="apps-finance-expense-category.html" class="side-nav-link">
                                                <span class="menu-text" data-lang="apps-finance-expense-category">Expense Category</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-finance-income.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-finance-income">Income</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-finance-transactions.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-finance-transactions">Transactions</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#support-center" aria-expanded="false" aria-controls="support-center" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-headset"></i></span>
                        <span class="menu-text" data-lang="support-center">Support Center</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="support-center">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="apps-ticket-list.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-ticket-list">Ticket List</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-ticket-details.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-ticket-details">Ticket Details</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="apps-ticket-create.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-ticket-create">New Ticket</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#promo" aria-expanded="false" aria-controls="promo" class="side-nav-link">
                        <span class="menu-icon"><i class="ti ti-discount"></i></span>
                        <span class="menu-text" data-lang="promo">Promo</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="promo">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="apps-promo-coupons.html" class="side-nav-link">
                                    <span class="menu-text" data-lang="apps-promo-coupons">Coupons</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

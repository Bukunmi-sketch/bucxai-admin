
                <div class="container-fluid bg-white news-ticker">
                    <div class="bg-white">
                        <div class="best-ticker" id="newsticker">
                            <div class="bn-news">
                                <ul>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-users bg-danger-transparent text-danger mx-1"></span>
                                        <span class="d-inline-block">Total Users</span>
                                        <span class="bn-positive me-4">{{ number_format($totalUsers) }}</span>
                                    </li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-signal bg-info-transparent text-info mx-1"></span>
                                        <span class="d-inline-block">Verified Users (BVN)</span>
                                        <span class="bn-negative me-4">{{ number_format($totalUsersWithBVN) }}</span>
                                    </li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-briefcase bg-success-transparent text-success mx-1"></span>
                                        <span class="d-inline-block"> Total Admins </span>
                                        <span class="bn-negative me-4">{{ number_format($totalAdmins) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-trophy bg-warning-transparent text-warning mx-1"></span>
                                        <span class="d-inline-block">Total Agents</span>
                                        <span class="bn-positive me-4">{{ number_format($totalAgents) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-envelope bg-primary-transparent text-primary mx-1"></span>
                                        <span class="d-inline-block">Total Transaction</span>
                                        <span class="bn-positive me-4">{{ $totalTransactions }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-check-circle bg-danger-transparent text-danger mx-1"></span>
                                        <span class="d-inline-block">Approved Transactions</span>
                                        <span class="bn-positive me-4">{{ number_format($approvedTransactions) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-envelope bg-secondary-transparent text-secondary mx-1"></span>
                                        <span class="d-inline-block">Pending Transactions</span>
                                        <span class="bn-positive me-4">{{ number_format($pendingTransactions) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-times-circle bg-info-transparent text-info mx-1"></span>
                                        <span class="d-inline-block">Failed Transactions</span>
                                        <span class="bn-positive me-4"> {{ number_format($failedTransactions) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-usd bg-success-transparent text-success mx-1"></span>
                                        <span class="d-inline-block">Today Sales</span>
                                        <span class="bn-negative me-4">#{{ number_format($todaySales, 2) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-shopping-cart bg-danger-transparent text-danger mx-1"></span>
                                        <span class="d-inline-block">Today Sales Count</span>
                                        <span class="bn-negative me-4">{{ number_format($todayTotalSales) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-money bg-warning-transparent text-warning"></span>
                                        <span class="d-inline-block">Bill Payments</span>
                                        <span class="bn-positive me-4">{{ number_format($billPayment) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-usd bg-danger-transparent text-danger mx-1"></span>
                                        <span class="d-inline-block">Buy Airtime</span>
                                        <span class="bn-negative me-4">{{ number_format($buyAirtime) }}</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-money bg-primary-transparent text-primary mx-1"></span>
                                        <span class="d-inline-block">Data Topup</span>
                                        <span class="bn-negative me-4">{{ number_format($dataTopup) }}</span></li>
                                    {{-- <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-briefcase bg-info-transparent text-info mx-1"></span>
                                        <span class="d-inline-block">Total Projects</span>
                                        <span class="bn-positive me-4">3,456</span></li>
                                    <li class="text-muted fs-13 fw-semibold">
                                        <span class="fa fa-users bg-success-transparent text-success mx-1"></span>
                                        <span class="d-inline-block">Total Employes</span>
                                        <span class="bn-positive me-4">4,738</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

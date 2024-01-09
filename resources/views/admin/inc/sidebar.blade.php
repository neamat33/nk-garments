<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @can('dashboard')
                <li><a href="{{ url('home') }}">
                        <i class="flaticon-381-networking"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
            @endcan

            @can('create-bank_account')
                <li>
                    <a href="{{ route('bank_account.index') }}">
                        <i class="fas fa-university"></i>
                        <span class="nav-text">Bank Account</span>
                    </a>
                </li>
            @endcan

            @can('create-department')
                <li>
                    <a href="{{ route('department.create') }}">
                        <i class="fas fa-hotel"></i>
                        <span class="nav-text">Department</span>
                    </a>
                </li>
            @endcan

            @canany(['list-production_send', 'create-production_send', 'list-production_receive',
                'create-production_receive', 'petty_purchase_report'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="nav-text">Production</span>
                    </a>
                    @canany(['list-production_send', 'create-production_send'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Production Send</a>
                                <ul aria-expanded="false">
                                    @can('create-production_send')
                                        <li><a href="{{ route('production_send.create') }}">Production Send Add</a></li>
                                    @endcan

                                    @can('list-production_send')
                                        <li><a href="{{ route('production_send.index') }}">Production Send List</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-production_receive', 'create-production_receive'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Production Receive</a>
                                <ul aria-expanded="false">
                                    @can('create-production_receive')
                                        <li><a href="{{ route('production_receive.create') }}">Production Receive Add</a></li>
                                    @endcan

                                    @can('list-production_receive')
                                        <li><a href="{{ route('production_receive.index') }}">Production Receive List</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-bulk_send', 'create-bulk_send'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Bulk Send</a>
                                <ul aria-expanded="false">
                                    @can('create-bulk_send')
                                        <li><a href="{{ route('bulk_send.create') }}">Add </a></li>
                                    @endcan

                                    @can('list-bulk_send')
                                        <li><a href="{{ route('bulk_send.index') }}">Log</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany
                    @canany(['list-knitting', 'create-knitting'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Knitting</a>
                                <ul aria-expanded="false">
                                    @can('create-knitting')
                                        <li><a href="{{ route('knitting.create') }}">Add </a></li>
                                    @endcan

                                    @can('list-knitting')
                                        <li><a href="{{ route('knitting.index') }}">Log</a></li>
                                    @endcan

                                    @can('knitting-stock')
                                        <li><a href="{{ route('knitting.stock') }}">Stock</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany
                    @canany(['list-knitting', 'create-knitting'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cutting</a>
                                <ul aria-expanded="false">
                                    @can('create-knitting')
                                        <li><a href="{{ route('cutting.create') }}">Add </a></li>
                                    @endcan

                                    @can('list-knitting')
                                        <li><a href="{{ route('cutting.index') }}">Log</a></li>
                                    @endcan

                                    @can('list-knitting')
                                        <li><a href="{{ route('cutting.report') }}">Report</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany
                </li>
            @endcanany
            {{-- Third Party Production  --}}
            @canany(['list-tp_production_send', 'create-tp_production_send', 'list-production_receive',
                'create-production_receive', 'petty_purchase_report'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="nav-text">TP Production</span>
                    </a>
                    @canany(['list-tp_production_send', 'create-tp_production_send'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">TP Production Send</a>
                                <ul aria-expanded="false">
                                    @can('create-tp_production_send')
                                        <li><a href="{{ route('tp_production_send.create') }}">TP Production Send</a></li>
                                    @endcan

                                    @can('list-tp_production_send')
                                        <li><a href="{{ route('tp_production_send.index') }}">TP Production Send List</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-tp_production_receive', 'create-tp_production_receive'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">TP Production Receive</a>
                                <ul aria-expanded="false">
                                    @can('create-tp_production_receive')
                                        <li><a href="{{ route('tp_production_receive.create') }}">TP Production Receive</a></li>
                                    @endcan

                                    @can('list-tp_production_receive')
                                        <li><a href="{{ route('tp_production_receive.index') }}">TP Production Receive List</a></li>
                                    @endcan

                                    @can('list-tp_production_receive')
                                        <li><a href="{{ route('tp_production_receive.stock') }}"> Reports</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany
                </li>
            @endcanany

            @canany(['list-item', 'create-item', 'create-brand', 'create-unit', 'item-stock'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-box"></i>
                        <span class="nav-text">Items</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('list-item')
                            <li><a href="{{ route('item.create') }}">Item Create</a></li>
                        @endcan

                        @can('list-item')
                            <li><a href="{{ route('item.index') }}">Item List</a></li>
                        @endcan

                        @can('create-brand')
                            <li><a href="{{ route('brand.create') }}">Brand Create</a></li>
                        @endcan

                        @can('create-unit')
                            <li><a href="{{ route('unit.create') }}">Unit Create</a></li>
                        @endcan

                        @can('item-stock')
                            <li><a href="{{ route('item.stock') }}">Stock</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['list-party_purchase', 'create-party_purchase', 'party_purchase_report', 'list-petty_purchase',
                'create-petty_purchase', 'petty_purchase_report'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="nav-text">Purchase</span>
                    </a>
                    @canany(['list-party_purchase', 'create-party_purchase', 'party_purchase_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Party Purchase</a>
                                <ul aria-expanded="false">
                                    @can('create-party_purchase')
                                        <li><a href="{{ route('party-purchase.create') }}">Purchase Create</a></li>
                                    @endcan

                                    @can('list-party_purchase')
                                        <li><a href="{{ route('party-purchase.index') }}">Purchase List</a></li>
                                    @endcan

                                    @can('list-party_purchase_return')
                                        <li><a href="{{ route('party-purchase.report') }}">Purchase Report</a></li>
                                    @endcan

                                    @can('list-party_sale_return')
                                        <li><a href="{{ route('party-purchase-return.index') }}">Purchase Return List</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-petty_purchase', 'create-petty_purchase', 'party_purchase_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Petty Purchase</a>
                                <ul aria-expanded="false">
                                    @can('create-petty_purchase')
                                        <li><a href="{{ route('petty-purchase.create') }}">Purchase Create</a></li>
                                    @endcan

                                    @can('list-petty_purchase')
                                        <li><a href="{{ route('petty-purchase.index') }}">Purchase List</a></li>
                                    @endcan

                                    @can('petty_purchase_report')
                                        <li><a href="{{ route('petty-purchase.report') }}">Purchase Report</a></li>
                                    @endcan

                                    @can('list-petty_purchase_return')
                                        <li><a href="{{ route('petty-purchase-return.index') }}">Purchase Return List</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany
                </li>
            @endcanany

            @canany(['list-party_sale', 'create-party_sale', 'party_sale_report', 'create-party_sale_commission',
                'list-party_sale_commission', 'list-cash_sale', 'create-cash_sale', 'cash_sale_report',
                'list-cash_sale_return', 'list-wastage_sale', 'create-wastage_sale', 'wastage_sale_report'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="nav-text">Sales</span>
                    </a>
                    @canany(['list-party_sale', 'create-party_sale', 'party_sale_report', 'list-party_sale_return',
                        'create-party_sale_commission', 'list-party_sale_commission'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Party Sale</a>
                                <ul aria-expanded="false">
                                    @can('create-party_sale')
                                        <li><a href="{{ route('party-sale.create') }}">Add Party Sale</a></li>
                                    @endcan

                                    @can('list-party_sale')
                                        <li><a href="{{ route('party-sale.index') }}">Party Sales List</a></li>
                                    @endcan

                                    @can('party_sale_report')
                                        <li><a href="{{ route('party-sale.report') }}">Party Sales Report</a></li>
                                    @endcan

                                    @can('list-party_sale_return')
                                        <li><a href="{{ route('party-sale-return.index') }}">Party Sales Return List</a></li>
                                    @endcan

                                    @can('create-party_sale_commission')
                                        <li><a href="{{ route('party-sale-commission.create') }}">Add Commission</a></li>
                                    @endcan

                                    @can('list-party_sale_commission')
                                        <li><a href="{{ route('party-sale-commission.index') }}">Commission List</a></li>
                                    @endcan

                                    @can('party_sale_add_payment')
                                        <li><a href="{{ route('party-sale-payment.create') }}">Add Party Payment</a></li>
                                    @endcan

                                    @can('party_sale_payment_list')
                                        <li><a href="{{ route('party-sale-payment.index') }}">Party Payments List</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-cash_sale', 'create-cash_sale', 'cash_sale_report', 'list-cash_sale_return'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Sale</a>
                                <ul aria-expanded="false">
                                    @can('create-cash_sale')
                                        <li><a href="{{ route('cash-sale.create') }}">Add Cash Sale</a></li>
                                    @endcan

                                    @can('list-cash_sale')
                                        <li><a href="{{ route('cash-sale.index') }}">Cash Sales List</a></li>
                                    @endcan

                                    @can('cash_sale_report')
                                        <li><a href="{{ route('cash-sale.report') }}">Cash Sales Report</a></li>
                                    @endcan

                                    @can('list-cash_sale_return')
                                        <li><a href="{{ route('cash-sale-return.index') }}">Cash Sales Return List</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-wastage_sale', 'create-wastage_sale', 'wastage_sale_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Wastage Sale</a>
                                <ul aria-expanded="false">
                                    @can('create-wastage_sale')
                                        <li><a href="{{ route('wastage-sale.create') }}">Add Wastage Sale</a></li>
                                    @endcan

                                    @can('list-wastage_sale')
                                        <li><a href="{{ route('wastage-sale.index') }}">Wastage Sales List</a></li>
                                    @endcan

                                    @can('wastage_sale_report')
                                        <li><a href="{{ route('wastage-sale.report') }}">Wastage Sales Report</a></li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    @endcanany
                </li>
            @endcanany

            @canany(['list-receive_challan', 'receive_challan_report', 'list-delivery_challan',
                'delivery_challan_report', 'list-moving_challan', 'create-moving_challan', 'moving_challan_report'])
                <li>
                    <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-truck"></i>
                        <span class="nav-text">Challan</span>
                    </a>

                    @canany(['list-receive_challan', 'receive_challan_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Receive Challan</a>
                                <ul aria-expanded="false">
                                    @can('list-receive_challan')
                                        <li><a href="{{ route('receive-challan.index') }}">Receive Challan List</a></li>
                                    @endcan

                                    @can('receive_challan_report')
                                        <li><a href="{{ route('receive-challan.report') }}">Receive Challan Report</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-delivery_challan', 'delivery_challan_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Delivery Challan</a>
                                <ul aria-expanded="false">
                                    @can('list-receive_challan')
                                        <li><a href="{{ route('delivery-challan.index') }}">Delivery Challan List</a></li>
                                    @endcan

                                    @can('delivery_challan_report')
                                        <li><a href="{{ route('delivery-challan.report') }}">Delivery Challan Report</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                    @canany(['list-moving_challan', 'create-moving_challan', 'moving_challan_report'])
                        <ul aria-expanded="false">
                            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Moving Challan</a>
                                <ul aria-expanded="false">
                                    @can('create-moving_challan')
                                        <li><a href="{{ route('moving-challan.create') }}">Add Moving Challan</a></li>
                                    @endcan

                                    @can('list-moving_challan')
                                        <li><a href="{{ route('moving-challan.index') }}">Moving Challan List</a></li>
                                    @endcan

                                    @can('moving_challan_report')
                                        <li><a href="{{ route('moving-challan.report') }}">Moving Challan Report</a></li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    @endcanany

                </li>
            @endcanany

            @can('list-payment')
                <li>
                    <a href="{{ route('payment.index') }}">
                        <i class="fa-regular fa-money-bill-1"></i>
                        <span class="nav-text">Payments List</span>
                    </a>
                </li>
            @endcan

            @canany(['list-employee', 'create-employee'])
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-users-cog"></i>
                        <span class="nav-text">Employee</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('create-employee')
                            <li><a href="{{ route('employee.create') }}">Employee Create</a></li>
                        @endcan

                        @can('list-employee')
                            <li><a href="{{ route('employee.index') }}">Employee List</a></li>
                        @endcan

                    </ul>
                </li>
            @endcanany

            @canany(['top_sale_item_report', 'top_purchase_item_report'])
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-book"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('top_sale_item_report')
                            <li><a href="{{ route('top-sale-item.report') }}">Top Sale Item</a></li>
                        @endcan

                        @can('top_purchase_item_report')
                            <li><a href="{{ route('top-purchase-item.report') }}">Top Purchase Item</a></li>
                        @endcan
                        <li><a href="{{ route('top-sale-party.report') }}">Top Sale Party</a></li>
                        <li><a href="{{ route('top-purchase-party.report') }}">Top Purchase Party</a></li>
                    </ul>
                </li>
            @endcanany

            @canany(['list-party', 'create-party'])
                <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                        <i class="fas fa-user-friends"></i>
                        <span class="nav-text">Party</span>
                    </a>
                    <ul aria-expanded="false">
                        @can('create-party')
                            <li><a href="{{ route('party.create') }}">Party Create</a></li>
                        @endcan

                        @can('list-party')
                            <li><a href="{{ route('party.index') }}">Party List</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['list-role', 'create-role', 'list-user', 'create-user', 'setting'])
                <li>
                    <a href="#">
                        <span class="nav-text">------ Setting & Customize ------</span>
                    </a>
                </li>
                @canany(['list-role', 'create-role'])
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-user-tag"></i>
                            <span class="nav-text">Roles</span>
                        </a>
                        <ul aria-expanded="false">
                            @can('list-user')
                                <li><a href="{{ route('roles.create') }}">Roles Create</a></li>
                            @endcan

                            @can('list-user')
                                <li><a href="{{ route('roles.index') }}">Roles List</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['list-user', 'create-user'])
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            @can('list-user')
                                <li><a href="{{ route('user.create') }}">User Create</a></li>
                            @endcan

                            @can('create-user')
                                <li><a href="{{ route('user.index') }}">User List</a></li>
                            @endcan

                        </ul>
                    </li>
                @endcanany
                @can('setting')
                    <li>
                        <a href="{{ route('setting') }}">
                            <i class="fas fa-wrench"></i>
                            <span class="nav-text">Setting</span>
                        </a>
                    </li>
                @endcan
            @endcanany
        </ul>

        <div class="copyright">
            <p><strong>Softghor Limited</strong> © {{ date('Y') }} All Rights Reserved</p>
            {{-- <p>Made with <span class="heart"></span> by zendbot</p> --}}
        </div>
    </div>
</div>

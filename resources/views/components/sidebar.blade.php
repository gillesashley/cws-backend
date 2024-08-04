<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <a href="{{ route('dashboard') }}">
                <h4 class="logo-text">CWS</h4>
            </a>
        </div>
        <div class="toggle-icon ms-auto"><ion-icon name="menu-sharp"></ion-icon>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('dashboard')}}">
                <div class="parent-icon"><ion-icon name="home-sharp"></ion-icon>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li class="menu-label">Campaign Administration</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><ion-icon name="briefcase-sharp"></ion-icon>
                </div>
                <div class="menu-title">Campaign With Us</div>
            </a>
            <ul>
                <li> <a href="{{ route('targeted-messages.all.index') }}"><ion-icon
                            name="ellipse-outline"></ion-icon>Affiliate
                        Campaigns</a>
                </li>
                <li>
                    <a href="{{ route('targeted-messages.whatsapp.index') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>WhatsApp Campaigns
                    </a>
                </li>
                <li>
                    <a href="{{ route('targeted-messages.sms.index') }}">
                        <ion-icon name="ellipse-outline"></ion-icon>SMS Campaigns
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{ route('admin.points-and-payment.index') }}">
                <div class="parent-icon"><ion-icon name="receipt-sharp"></ion-icon>
                </div>
                <div class="menu-title">Points & Payments</div>
            </a>
        </li>


        <li class="menu-label">Adversisements </li>
        <li>
            <a href="javascript:;" target="_blank">
                <div class="parent-icon"><ion-icon name="document-text-sharp"></ion-icon>
                </div>
                <div class="menu-title">Private</div>
            </a>
        </li>
        <li>
            <a href="avascript:;" target="_blank">
                <div class="parent-icon"><ion-icon name="link-sharp"></ion-icon>
                </div>
                <div class="menu-title">Adsense</div>
            </a>
        </li>

        <li class="menu-label">Administration</li>
        <li>
            <a href="{{ route('admin.admin-access.index') }}">
                <div class="parent-icon"><ion-icon name="lock-closed-sharp"></ion-icon>
                </div>
                <div class="menu-title">Admin Access Control</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <div class="parent-icon"><ion-icon name="person-circle-sharp"></ion-icon>
                </div>
                <div class="menu-title">All Users</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.geo-location.index') }}">
                <div class="parent-icon"><ion-icon name="create-sharp"></ion-icon>
                </div>
                <div class="menu-title">Geo Locations</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.support.profile') }}">
                <div class="parent-icon"><ion-icon name="document-text-sharp"></ion-icon>
                </div>
                <div class="menu-title">Admin Profile</div>
            </a>
        </li>

        <li class="menu-label">Support</li>
        <li>
            <a href="{{ route('admin.support.index') }}">
                <div class="parent-icon"><ion-icon name="link-sharp"></ion-icon>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->

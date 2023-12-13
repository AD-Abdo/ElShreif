    <header class="header no-print">
        <div class="logo-wrapper no-print">
            <a href="{{ URL::route('admin.home') }}" class="logo">
                <img src="{{ URL::asset('assets/img/logo.png') }}" alt="أكاديمية الشريف التعليمية" />
            </a>
            
        </div>
        <div class="header-items no-print">
            

            <!-- Header actions start -->
            <ul class="header-actions">
                
                <li class="dropdown">
                    <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                        <div class="header-profile-actions">
                            <div class="header-user-profile">
                                <h5>{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->role == 1 ? 'مدير النظام' :'مشرف للنظام' }}</p>
                            </div>
                            <a href="{{ URL::route('admin.edit.profile') }}"><i class="icon-user1"></i> حسابي</a>
                            <a href="{{ URL::route('admin.edit.password') }}"><i class="icon-settings1"></i> تغيير كلة المرور</a>
                            <a href="#" onclick="document.getElementById('logout').submit();"><i class="icon-log-out1"></i> تسجيل الخروج</a>
                            <form id="logout" method="POST" action="{{ URL::route('logout') }}" style="visibility: hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="quick-settings-btn" data-toggle="tooltip" data-placement="left" title=""
                        data-original-title="ارشادات النظام">
                        <i class="icon-list"></i>
                    </a>
                </li>
            </ul>
            <!-- Header actions end -->
        </div>
    </header>

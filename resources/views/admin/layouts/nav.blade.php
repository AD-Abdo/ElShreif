<nav class="navbar navbar-expand-lg custom-navbar no-print">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar"
        aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </button>
    <div class="collapse navbar-collapse" id="WafiAdminNavbar">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link  {{ $active[0] }}" href="{{ URL::route('admin.home') }}" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="icon-home1 nav-icon"></i>
                    الرئيسية
                </a>

            </li>

            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[1] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-school nav-icon"></i>
                    الصفوف
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.rows.create') }}">اضافة صف </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.rows.index') }}">كل الصفوف </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[2] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-users nav-icon"></i>
                    الطلاب
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.students.create') }}">اضافة طالب </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.students.index') }}">كل الطلاب </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[3] }}" href="{{ URL::route('admin.student_attendance.index') }}"
                    id="students" role="button" aria-expanded="false">
                    <i class="icon-check-square nav-icon"></i>
                    حضور الطلاب
                </a>

            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[4] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-attach_money nav-icon"></i>
                    المصاريف
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.salary.create') }}">اضافة مصاريف لطالب
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.salary.index') }}">كل المصاريف </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.salary.feature') }}">مدخلات النظام الكلية</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[5] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-view_quilt nav-icon"></i>
                    الجداول
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    @if (Auth::user()->role == 1)
                        <li>
                            <a class="dropdown-item" href="{{ URL::route('admin.table.create') }}">اضافة جدول </a>
                        </li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.table.index') }}">كل الجداول </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[6] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-subject nav-icon"></i>
                    المواد الدراسية
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.subject.create') }}">اضافة مادة </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.subject.index') }}">كل المواد </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[7] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-person_add nav-icon"></i>
                    المدرسين
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.teacher.create') }}">اضافة مدرس </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.teacher.index') }}">كل المدرسين </a>
                    </li>
                </ul>
            </li>
@if (Auth::user()->role == 1)

            <li class="nav-item dropdown">
                <a class="nav-link {{ $active[8] }} dropdown-toggle" href="#" id="students" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-check-circle nav-icon"></i>
                    حضور المدرسين
                </a>
                <ul class="dropdown-menu" aria-labelledby="students">
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.teacher_attendance.create') }}">حضور
                            مدرس</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ URL::route('admin.teacher_attendance.index') }}">كل حضور
                            المدرسين </a>
                    </li>
                </ul>
            </li>
            
                <li class="nav-item dropdown">
                    <a class="nav-link {{ $active[9] }}" href="{{ URL::route('admin.fatora.index') }}"
                        id="students" role="button" aria-expanded="false">
                        <i class="icon-insert_invitation nav-icon"></i>
                        فاتورة المدرس
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link {{ $active[10] }} dropdown-toggle" href="#" id="students" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-user nav-icon"></i>
                        المستخدمين
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="students">
                        <li>
                            <a class="dropdown-item" href="{{ URL::route('admin.user.create') }}">اضافة
                                مستخدم</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ URL::route('admin.user.index') }}">كل
                                المستخدمين </a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>
</nav>

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset("assets/dist/img/user.png")}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$user->name}}</p>
                <!-- Status -->
{{--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
            </div>
        </div>



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menüler</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> <span>Anasayfa</span></a></li>
            @role('Admin')
            <li ><a href="{{ route('admin.urunEkle') }}"><i class="fa fa-shopping-cart"></i> <span>Ürün Ekle</span></a></li>
            @endrole
{{--            <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>--}}
            <li class="treeview">
                <a href="#"><i class="fa fa-file"></i> <span>Teklif Formu</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.faturaListele') }}">Teklifler</a></li>
                    <li><a href="{{ route('admin.faturaEkle') }}">Teklif Ekle</a></li>

{{--                    <li><a href="{{ route('admin.teklifEkle') }}">Teklif Ekle</a></li>--}}
{{--                    <li><a href="{{ route('admin.teklifListele') }}">Listele</a></li>--}}
                </ul>
            </li>
{{--            <li class=""><a href="{{ route('admin.home') }}"><i class="fa fa-download"></i> <span>Excel indir</span></a></li>--}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

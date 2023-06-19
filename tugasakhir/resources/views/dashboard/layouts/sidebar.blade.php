 <!--**********************************
    Sidebar start
***********************************-->
<div class="nk-sidebar noprint">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Dashboard</li>
            <li>
                <a href="/kategori" aria-expanded="false">
                    <i class="fa fa-list menu-icon"></i><span class="nav-text">Kategori Alat Outdoor</span>
                </a>
            </li>
            <li class="<?php echo !empty($navbar) ? $navbar : '' ?>">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="fa fa-server menu-icon"></i><span class="nav-text">Master Data</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="/alatoutdoor"><i class="fa fa-shopping-bag menu-icon"></i>Data Alat Outdoor</a></li>
                </ul>
                <ul aria-expanded="false">
                    <li><a href="/opentrip"><i class="fa fa-motorcycle menu-icon"></i>Data Open Trip</a></li>
                </ul>
            </li>
            <li>
                <a href="/datauser" aria-expanded="false">
                    <i class="fa fa-users menu-icon"></i><span class="nav-text">Data User</span>
                </a>
            </li>
            <li>
                <a href="/penyewaan" aria-expanded="false">
                    <i class="fa fa-star menu-icon"></i><span class="nav-text">Penyewaan</span>
                </a>
            </li>
            <li>
                <a href="/pengembalian" aria-expanded="false">
                    <i class="fa fa-angle-double-left menu-icon"></i><span class="nav-text">Pengembalian</span>
                </a>
            </li>
            <li>
                <a href="/komentar" aria-expanded="false">
                    <i class="fa fa-quote-right menu-icon"></i><span class="nav-text">Kritik & Saran</span>
                </a>
            </li>
            <li>
                <a href="/report" aria-expanded="false">
                    <i class="fa fa-print menu-icon"></i><span class="nav-text">Report</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
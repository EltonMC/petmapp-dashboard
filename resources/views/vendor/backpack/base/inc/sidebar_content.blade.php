<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li class="treeview">
  <a href="#"><i class="fa fa-group"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
    <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Users</span></a></li>
    <li><a href='{{ backpack_url('phone') }}'><i class='fa fa-phone'></i> <span>Phones<span></a></li>    
    <li><a href='{{ backpack_url('address') }}'><i class='fa fa-map-marker	'></i> <span>Address<span></a></li>    
    <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Roles</span></a></li>
    <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissions</span></a></li>
  </ul>
</li>
<li class="treeview">
  <a href="#"><i class="fa fa-paw"></i> <span>Petshops</span> <i class="fa fa-angle-left pull-right"></i></a>
  <ul class="treeview-menu">
  <li><a href='{{ backpack_url('petshop') }}'><i class='fa fa-paw'></i> <span>Petshops<span></a></li>
    <li><a href='{{ backpack_url('petshopImage') }}'><i class='fa fa-image'></i> <span>Images<span></a></li>    
  </ul>
</li>
<li><a href='{{ backpack_url('service') }}'><i class='fa fa-suitcase'></i> <span>Services<span></a></li>
<li><a href='{{ backpack_url('turn') }}'><i class='fa fa-briefcase'></i> <span>Turns<span></a></li>
<li><a href='{{ backpack_url('reservation') }}'><i class='fa fa-calendar-check-o'></i> <span>Reservations<span></a></li>
<!-- <li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> -->

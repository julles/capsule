<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      @foreach($modelMenu->whereParentId(0)->orderBy('order','asc')->get() as $parent)

      <?php $countChild = $modelMenu->countChild($parent->id); ?>

      <li class = "{{ $countChild > 0 ? 'treeview' : '' }}">
        <a href="{{ $parent->permalink != '#' ? OG::urlBackend($parent->permalink.'/index') : '#' }}">
          <i class="{{ $parent->icon }}"></i> <span>{{ $parent->title }}</span> 
            @if($countChild > 0)
              <i class="fa fa-angle-left pull-right"></i>
            @endif
        </a>

        @if($countChild > 0)
          <ul class="treeview-menu">
            @foreach($modelMenu->whereParentId($parent->id)->orderBy('order','asc')->get() as $child)
              <li><a href="{{ OG::urlBackend($child->permalink.'/index') }}"><i class="fa fa-angle-right"></i>{{$child->title}}</a></li>
            @endforeach
          </ul>
        @endif

      </li>
      
      @endforeach
      
      <!--li class="treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
          <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
      </li-->
    
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
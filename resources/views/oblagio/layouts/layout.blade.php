@include('oblagio.layouts.header')
@include('oblagio.layouts.sidebar')

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {{ $menuAttribute->title }}
          </h1>
          <ol class="breadcrumb">
            @if(!empty($menuParent->id))
              <li><a href="#"><i class="fa fa-{{ $menuParent->icon }}"></i>{{ $menuParent->title }}</a></li>
            @endif
            <li><a href="{{ og()->urlBackend($menuAttribute->permalink) }}">{{ $menuAttribute->title }}</a></li>
            <li class="active">
              @if(!empty(actionAttribute()->id))
                {{ actionAttribute()->label }}
              @else
                {{ ucfirst(Request::segment(3)) }}
              @endif
            </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
           @yield('content')
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->

@include('oblagio.layouts.footer')

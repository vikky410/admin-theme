<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>{{$title=isset($title)?$title:''}}</title>
    <meta name="description" content="@yield('description')"/>
    <meta name="author" content="">
    <meta name="keywords" content="@yield('keywords')"/>
    <link rel="shortcut icon" href="{{asset('assets/admin/images/favicon.png')}}" type="image/png">

    {{ HTML::style('assets/admin/css/style.default.css?' . date("Ymd", time()) . '.css') }}
    {{ HTML::style('assets/admin/css/jquery.gritter.css?' . date("Ymd", time()) . '.css') }}
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="{{asset('assets/admin/js/html5shiv.js')}}"></script>
    <script src="{{asset('assets/admin/js/respond.min.js')}}"></script>
    <![endif]-->
    @section('css')
        {{-- include all required stylesheets --}}
    @show
    
</head>
<body>
   
<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
  
  <div class="leftpanel">
    
    <!-- logopanel -->
    <div class="logopanel">
        <h1><span>[</span>{{ $title }}<span>]</span></h1>
    </div>
    
    <!--  leftpanelinner -->
    <div class="leftpanelinner">    
        
        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">   
            <div class="media userlogged">
                <img alt="" src="{{asset('/assets/admin/images/photos/loggeduser.png')}}" class="media-object">
                <div class="media-body">
                    <h4>{{Auth::user()->username}}</h4>
                    <span>"Life is so..."</span>
                </div>
            </div>
          
            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
              <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
              <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>
          
        <h5 class="sidebartitle">Navigation</h5>
        <ul class="nav nav-pills nav-stacked nav-bracket">
        <?php
            $parentnav = array();
            $currentnav = array();
        ?>
        @foreach ($menu as $value)
            <?php if ( $value['nav-active'] ) { $parentnav = $value; } ?>
            <li class="{{$value['is_active']}} {{$value['is_parent']}} {{$value['nav-active']}}">
                <a href="{{url($value['url'])}}"><i class="{{$value['icons']}}"></i> <span>{{$value['name']}}</span></a>
                @if ($value['submenu'])
                <ul class="children" style="<?php if($value['is_active']) { echo 'display:block;'; }?>">
                    @foreach ($value['submenu'] as $val)
                        <?php if ($val['is_active']) { $currentnav = $val; } ?>
                        <li class="{{$val['is_active']}}"><a href="{{url($val['url'])}}"><i class="fa fa-caret-right"></i>{{$val['name']}}</a></li>
                    @endforeach        
                </ul>                    
                @endif
            </li>
        @endforeach
        </ul>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  
  <div class="mainpanel">
    <div class="headerbar">
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      
<!--       <form class="searchform" action="index.html" method="post"> -->
<!--         <input type="text" class="form-control" name="keyword" placeholder="Search here..." /> -->
<!--       </form> -->
      
      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('/assets/admin/images/photos/loggeduser.png')}}" alt="" />
                {{Auth::user()->username}}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
<!--                 <li><a href=""><i class="glyphicon glyphicon-user"></i> 我的信息</a></li> -->
<!--                 <li><a href=""><i class="glyphicon glyphicon-cog"></i> 账户设置</a></li> -->
<!--                 <li><a href=""><i class="glyphicon glyphicon-question-sign"></i> 帮助</a></li> -->
                <li><a href="{{ URL::route('admin.logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
              </ul>
            </div>
          </li>
<!--           <li> -->
<!--             <button id="chatview" class="btn btn-default tp-icon chat-icon"> -->
<!--                 <i class="glyphicon glyphicon-comment"></i> -->
<!--             </button> -->
<!--           </li> -->
        </ul>
      </div><!-- header-right -->
      
    </div><!-- headerbar -->
    <div class="pageheader">
      <h2>
          <i class="{{empty($parentnav) ? : $parentnav['icons']}}"></i>
          {{empty($parentnav) ? '' : $parentnav['name']}}
          <?php 
              if (!empty($currentnav))
              {
                  echo '<span>';
                  echo $currentnav['name'];
                  echo '</span>';
              }
          ?>
      </h2>
      
      <?php /*
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="{{empty($parentnav) ? '' : url($parentnav['url'])}}">{{empty($parentnav) ? : $parentnav['name']}}</a></li>
          <li class="active">{{empty($currentnav) ? '' : $currentnav['name']}}</li>
        </ol>
      </div>
      */?>
    </div>
    <?php if (isset($successMessage)) {?>
    <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Success!</strong> {{$successMessage}}.
    </div>
    <?php } ?>
    <?php if (isset($errorMessage)) {?>
    <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Errror !</strong>  {{$errorMessage}}.
    </div>
    <?php } ?>
    <div class="contentpanel">
         @yield('content')
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->
  
  
  
  
</section>


<script src="{{asset('/assets/admin/js/jquery-1.11.1.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/jquery-ui-1.10.3.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/modernizr.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/toggles.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/retina.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/jquery.cookies.js')}}"></script>
<script src="{{asset('/assets/admin/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('/assets/admin/js/custom.js')}}"></script>
@yield('footer-content')
@yield('footer')

<script type="text/javascript">
function gritterWindows(title, content, class_name) {
    jQuery.gritter.add({
        title: title,
        text:  content,
        class_name: class_name,
        image: '{{asset("/assets/admin/images/screen.png")}}',
        sticky: false,
        time: ''
    });
};

function notify(title, text, type){
    var sticky = arguments[3] || false;
    var time = arguments[4] || '';
    $.gritter.add({
        title: title,
        text: text,
        class_name: 'growl-' + type,
        sticky: false,
        time: ''
    });
    return false;
};
</script>
</body>
</html>
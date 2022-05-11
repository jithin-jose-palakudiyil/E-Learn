<div class="sidebar sidebar-main sidebar-fixed">
    <div class="sidebar-content"> 
        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <?php 
                        $profile_img = 'public/images/user-default.png';  
                        if(Auth::guard(admin_guard)->user()->image):
                            $path = 'public/uploads/admin_user/'.Auth::guard(admin_guard)->user()->id.'/'.Auth::guard(admin_guard)->user()->image; 
                            if(File::exists($path)):  $profile_img = $path;  endif;     
                        endif;
                    ?>
                    <a href="#" class="media-left"><img src="{{asset($profile_img)}}" class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold">{{Auth::guard(admin_guard)->user()->name}}</span> 
                    </div> 
                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li> <a href="{{route('admin_logout')}}"><i class="icon-switch2"></i></a> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->
 
        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">
                    <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li> 
                    <li <?php if(isset($active) && $active == 'dashboard'){echo 'class="active"'; } ?>>
                        <a href="{{url(admin_prefix.'/dashboard')}}">
                            <i class="icon-home4"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <?php 
                    $AdminUsers = \Modules\BackEnd\Entities\AdminUsers::with('get_permissions')->where('id',Auth::guard(admin_guard)->user()->id)->first();
                    if(isset($AdminUsers->get_permissions) && $AdminUsers->get_permissions->isNotEmpty()):
                        $permissions = $AdminUsers->get_permissions;    
                        $module_id = $permissions->pluck('module_id')->unique();
                        foreach ($module_id as $key => $value): 
                            $module_permission =$permissions->where('module_id',$value);

                            // Question Module
                            $question_module_main = ['question-category-list','questions-list'];
                            $hasQuestion = $module_permission->contains(function ($val, $key) use ($question_module_main) { if (in_array($val->slug, $question_module_main)) : return true; else: return false; endif;});
                            if($hasQuestion):
                                ?>
                                <li>
                                    <a href="#"><i class="icon-dice"></i> <span>Question</span></a>
                                    <ul>
                                        <?php if($module_permission->contains('slug','question-category-list')): ?> 
                                        <li <?php if(isset($active) && $active == 'question-category'): echo 'class="active"';  endif;  ?> ><a href="{{route('question-category')}}"><i class="icon-arrow-right13"></i>Category </a></li>
                                        <?php  endif; ?>
                                        
                                        <?php if($module_permission->contains('slug','questions-list')): ?> 
                                        <li <?php if(isset($active) && $active == 'questions'): echo 'class="active"';  endif;  ?> ><a href="{{route('questions')}}"><i class="icon-arrow-right13"></i> Questions </a></li>  
                                        <?php  endif; ?>
                                    </ul>
                                </li>
                                <?php
                            endif;
                            //Question Module End
                            ?>
                            <!-- package Module -->
                            <?php if($module_permission->contains('slug','package-list')): ?>               
                            <li <?php if(isset($active) && $active == 'package'){echo 'class="active"'; } ?>>
                                <a href="{{route('packages')}}">
                                    <i class="icon-package"></i>
                                    <span>Package</span>
                                </a>
                            </li>
                            <?php  endif; ?>
                            <!-- package Module End -->
                            
                            
                            
                            <?php
                        endforeach;
                    endif;
                    ?>



                </ul>
            </div>
        </div>
        <!-- /main navigation --> 
    </div>
</div>
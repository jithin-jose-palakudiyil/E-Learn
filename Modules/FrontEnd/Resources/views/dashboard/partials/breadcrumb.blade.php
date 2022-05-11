 <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content dashboard-bread-content d-flex align-items-center justify-content-between">
                        <div class="user-bread-content d-flex align-items-center">
                            <div class="bread-img-wrap">
                                <?php 
                                    $profile_img = 'public/images/sample/team11.jpg';   
                                    if(Auth::guard(user_guard)->user()->profile_image != null):
                                        $path = 'public/uploads/students/'.Auth::guard(user_guard)->user()->id.'/'.Auth::guard(user_guard)->user()->profile_image; 
                                        if(File::exists($path)): 
                                            $profile_img = $path;    
                                        endif;     
                                    endif;
                                ?>
                                <img src="{{asset($profile_img)}}" alt="">
                            </div>
                            
                            <div class="section-heading">
                                <h2 class="section__title font-size-30">Hello, {{Auth::guard(user_guard)->user()->first_name}} {{Auth::guard(user_guard)->user()->last_name}}</h2>
                              
                            </div>
                        </div>
                        
                    </div>
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="section-block"></div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <h3 class="widget-title"><?php if(isset($breadcrumbTitle)): echo $breadcrumbTitle;  endif; ?></h3>
                   
                </div>
            </div>
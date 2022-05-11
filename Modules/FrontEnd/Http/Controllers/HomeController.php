<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {  
        $page_title = 'Elearn - Test yourself';
        $packages = \Modules\FrontEnd\Entities\Packages::with(array('question_category' => function($query) {
                    $query->where('status', '=', 1);
                    
                    }))->where('status',1)->where('is_publish',1)->get();
        $question_category_ = $packages->pluck('question_category')->unique();     
      
      
 $question_category= $question_category_->flatten();

        return view('frontend::home.index', compact('page_title','packages','question_category'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $page_title = 'Elearn - Tsest yourself';
        return view('frontend::create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
    
    
    public function example()
    {
        
       $array =[ 
           'questions' =>[
           
    
           
                                       [   'question_id' => 1, 
                                           'question' => 'A particle starts its motion from rest under the action of a constant force. If  the distance covered in first 10 seconds is  ',
                                           'answers' =>
                                                           [
                                                               '1'=>['answer'=>'yes','is_correct'=>false, 'answer_id'=>1],
                                                               '2'=>['answer'=>'No','is_correct'=>false, 'answer_id'=>2],
                                                               '21'=>['answer'=>'Other','is_correct'=>true, 'answer_id'=>3]
                                                               
                                                           ]
                                       ],
                                       [    'question_id' => 2, 
                                           'question' => 'The smallest positive root of the equation,  ',
                                           'answers' =>
                                                           [
                                                               '1'=>['answer'=>'2','is_correct'=>false, 'answer_id'=>4],
                                                               '2'=>['answer'=>'333','is_correct'=>false, 'answer_id'=>5],
                                                               '3'=>['answer'=>'N7o','is_correct'=>true, 'answer_id'=>6],
                                                               '4'=>['answer'=>'N7asdasdo','is_correct'=>false, 'answer_id'=>7],
                                                               
                                                           ]
                                       ],
                                       ['question_id' => 3, 
                                        'question' => 'The smallest positive root,  ',
                                        'answers' =>
                                                        [
                                                            '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>8],
                                                            '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>9],
                                                            '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>10],
                                                            '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>11],
                                                            
                                                        ]
                                    ],
                                    ['question_id' => 4, 
                                     'question' => 'The smallest positive root,  ',
                                     'answers' =>
                                                     [
                                                         '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>12],
                                                         '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>13],
                                                         '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>14],
                                                         '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>15],
                                                         
                                                     ]
                                 ],
                                 ['question_id' => 5, 
                                  'question' => 'The smallest positive root,  ',
                                  'answers' =>
                                                  [
                                                      '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>16],
                                                      '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>17],
                                                      '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>18],
                                                      '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>19],
                                                      
                                                  ]
                              ],
                              ['question_id' => 6, 
                               'question' => 'The smallest positive root,  ',
                               'answers' =>
                                               [
                                                   '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>20],
                                                   '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>21],
                                                   '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>22],
                                                   '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>23],
                                                   
                                               ]
                           ],
                           ['question_id' => 7, 
                            'question' => 'The smallest positive root,  ',
                            'answers' =>
                                            [
                                                '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>24],
                                                '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>25],
                                                '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>26],
                                                '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>27],
                                                
                                            ]
                        ],
                        ['question_id' => 8, 
                         'question' => 'The smallest positive root,  ',
                         'answers' =>
                                         [
                                             '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>28],
                                             '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>29],
                                             '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>30],
                                             '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>31],
                                             
                                         ]
                     ],
                     ['question_id' => 9, 
                      'question' => 'The smallest positive root,  ',
                      'answers' =>
                                      [
                                          '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>32],
                                          '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>33],
                                          '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>34],
                                          '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>35],
                                          
                                      ]
                  ],
                  ['question_id' => 10, 
                   'question' => 'The smallest positive root,  ',
                   'answers' =>
                                   [
                                       '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>36],
                                       '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>37],
                                       '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>38],
                                       '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>39],
                                       
                                   ]
               ],
               ['question_id' => 11, 
                'question' => 'The smallest positive root,  ',
                'answers' =>
                                [
                                    '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>40],
                                    '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>41],
                                    '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>42],
                                    '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>43],
                                    
                                ]
            ],
            ['question_id' => 12, 
             'question' => 'The smallest positive root,  ',
             'answers' =>
                             [
                                 '1'=>['answer'=>'55','is_correct'=>false, 'answer_id'=>44],
                                 '2'=>['answer'=>'0000','is_correct'=>false, 'answer_id'=>45],
                                 '3'=>['answer'=>'N7oq4as/A','is_correct'=>true, 'answer_id'=>46],
                                 '4'=>['answer'=>'N7asdasdoASDASD','is_correct'=>false, 'answer_id'=>47],
                                 
                             ]
         ]
              ],
 
           
       ];
       return response()->json($array);
    //    echo json_encode($array);;
        
//         $data = [
         
//         1 =>   [
//                                             'question' => 'question 1',
//                                             'answers' =>
//                                                             [
//                                                                 '1'=>['answer'=>'yes','is_correct'=>false],
//                                                                 '21'=>['answer'=>'Other','is_correct'=>true],
//                                                                 '2'=>['answer'=>'No','is_correct'=>false],
                                                                
//                                                             ]
//                                         ],
//             2 =>   [
//                                             'question' => 'question 2',
//                                             'answers' =>
//                                                             [
//                                                                 '1'=>['answer'=>'yes','is_correct'=>false],
//                                                                 '21'=>['answer'=>'Other','is_correct'=>true],
//                                                                 '2'=>['answer'=>'No','is_correct'=>false],
                                                                
//                                                             ]
//                                         ],
// ];

return response()->json($data);
    }
    
    
    
    public function test_exam()
    {
        $headertop_disable = true;
        $page_title = '  Elearn - Test yourself';
        return view('frontend::.exam.index', compact('page_title','headertop_disable'));
    }  
    
    public function test_exam_trials()
    {
        $page_title = '  Elearn - Test yourself(React test)';
        return view('frontend::.exam.index-test', compact('page_title'));
    } 
}

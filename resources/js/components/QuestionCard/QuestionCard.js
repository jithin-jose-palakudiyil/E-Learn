import React from 'react';


const QuestionCard = ({questions,show, totalQuestions, currentPage, attendedObjectCaller}) => {    

    return(
        <div className="container"> 
        <div className="row">
            <div className="col-lg-12 ">
                <div className={show?"Test-content questionAreaWithSideDrawer":"Test-content questionArea"}>
                    <div className="d-flex align-items-center justify-content-between">
                        <h2 className="section__title text-white">{`Question ${currentPage} of ${totalQuestions}`}</h2>
                        {/* <p className="lead text-white font-size-25 font-weight-medium mb-0">00:16</p> */}
                    </div>
                    
                    {questions.map(question => {

                        attendedObjectCaller(question.question_id, currentPage);
                        return(
                            <p key={question.question}
                             className={show?"questionWithSideDrawer section__desc Test-desc text-color-rgba mb-0 pt-3":"section__desc Test-desc text-color-rgba mb-0 pt-3"}>{question.question}</p>)}

                        )
                    }

                </div>
            </div>
         </div>
    </div>  
)};


export default QuestionCard;
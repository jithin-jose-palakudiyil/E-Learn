import React from 'react';



const Answers = ({questions,show, setCurrentQuestionId, attendedObjectHandler, attendedQuizzes}) => {


    return(
        <div style={{background: "#fafafa"}} className="Test-ans-wrap padding-top-20px padding-bottom-20px">
        <div className="container">
            <div className="row">
                <div className="col-lg-12">
                    <div className={show?"Test-ans-content AnswerAreaWithSideDrawer":"Test-ans-content"}>
                        <h3 className="widget-title">Your Answer:</h3>
                        <ul className="py-3">     

                        { questions.map(quiz=> {
                            let selectedKey =  attendedQuizzes[quiz.question_id];
                            setCurrentQuestionId(quiz.question_id)
                        return(
                            Object.keys(quiz["answers"]).map((answer, index) => {
                             return(
                               
                                <li style={{marginBottom: 10}}  key={quiz["answers"][answer]["answer_id"]}>
                                <div className="custom-checkbox">
                                    <input 
                                    defaultChecked={typeof(selectedKey) !== 'undefined' && selectedKey.answer_id == quiz["answers"][answer]["answer_id"]}
                                    // disabled={selectedKey.answer_index && selectedKey.answer_index === index}
                                    type="checkbox" 
                                    id={quiz["answers"][answer]["answer_id"]} 
                                    value={quiz["answers"][answer]["answer_id"]}
                                    onChange={(e)=>attendedObjectHandler( e,quiz.question_id, quiz["answers"][answer]["is_correct"], index)}
                                    />
                                    <label style={{color:'#292f38'}} htmlFor={quiz["answers"][answer]["answer_id"]}>{quiz["answers"][answer]["answer"]}</label>
                                </div>
                            </li>
                             )
                        })
                        )
                        })}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    )
}


export default Answers
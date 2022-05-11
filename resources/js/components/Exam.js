import React,{useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
import Cookies from 'js-cookie'
import * as uuid from 'uuid'

//Components
import Questioncard from './QuestionCard/QuestionCard';
import Answers from './Answers/Answers';
import Sidedrawer from './UI/Sidedrawer/Sidedrawer';
import Backdrop from './UI/Backdrop/Backdrop'
import Timer from './Timer/Timer';
import Modal from './UI/Modal/Modal';
import ResultBackdrop from './ResultBackdrop/ResultBackdrop'

//CSS
import './Exam.css'

//utils
import useMediaQuery from './utils/useMediaQuery'

//API
import quizzies from '../api/quizzies';



const Exam = () => {

    const [quizzes, setQuizzes] = useState([]);
    const [quizTimer, setQuizTimer] = useState(0)
    const [attendedQuizzes, setAttendedQuizzes] = useState({});
    const [currentPage, setCurrentPage] = useState(1);
    const [QuestionPerPage] = useState(1);
    const [previousDisabled, setPreviousDisabled] = useState(false)
    const [nextDisabled, setNextDisabled] = useState(false)
    const [showSideDrawer, setShowSideDrawer] = useState(true)
    const [currentQuestionId, setCurrentQuestionId] = useState()
    const [showModal, setShowModal] = useState(false)
    const [timeoutDisable, setTimeoutDisable] = useState(false)

    Cookies.set("exam_session", uuid.v4());
    let exam_session = Cookies.get("exam_session");
    let currentExamSession;
    if(!localStorage.getItem("currentExamSession")){
        localStorage.setItem("currentExamSession", exam_session)
        currentExamSession = localStorage.getItem("currentExamSession")
    }

    
//    const onBlur = () => {
//     alert('Hey you are trying to leave the current tab');
//   };

//   useEffect(() => {
//     window.addEventListener('focus', onFocus);
//     window.addEventListener('blur', onBlur);
//     window.addEventListener("beforeunload", (event) => onUnload(event))
//     Specify how to clean up after this effect:
//     return () => {
//       window.removeEventListener('focus', onFocus);
//       window.removeEventListener('blur', onBlur);
//       window.removeEventListener("beforeunload", (event) => onUnload(event))
//     };
//   });


  

    const matches = useMediaQuery("(min-width: 811px)");


   let totalQuestions = quizzes.length;
   let totalAttendedQuestions =  Object.keys(attendedQuizzes).length;
 
        //Fetching data from API

        useEffect(() => {
            const fetchQuiz = async () => {
            const response = await quizzies.get('/example');
            const result = await response.data.questions;
            setQuizzes(result);
            //   setLoading(false);
            };
            fetchQuiz();
            return() => {
                quizzes = []
            }
        }, [setQuizzes]);

        const fetchTime = async () => {
            const response = await quizzies.get('/example');
            const result = await response.data.exam_time;
            localStorage.setItem("time", result) 
            if(!localStorage.getItem("timer")){
                localStorage.setItem("time", result) 
                localStorage.setItem("timer", moment().add(result , 'hours').format())
                setQuizTimer(localStorage.getItem("timer"))
                
            }else{
                setQuizTimer(localStorage.getItem("timer"))
            }
        }


        useEffect(() => {
            fetchTime();
    },[])


    //End Fetching data from API
 

            //pagination Logic

            const indexOfLastQuestion = currentPage * QuestionPerPage;
            const indexOfFirstQuestion = indexOfLastQuestion - QuestionPerPage;
            const currentQuestions = quizzes.slice(indexOfFirstQuestion, indexOfLastQuestion);
            
      
              // Change page
            const paginate = pageNumber => {
                setCurrentPage(pageNumber);
            } 
            
            
            const pageNumbers = [];
      
            for (let i = 1; i <= Math.ceil(totalQuestions / QuestionPerPage); i++) {
              pageNumbers.push(i);
            }
      
            //End Pagination Logic


        //onClick attended object handler -  Initialising Attended Quizzes

      const attendedObjectCaller = (qid,pageNo) => {
       if(qid===undefined) return;
          attendedQuizzes[qid]={
            ...attendedQuizzes[qid],
              visited: true,
              currentPage: pageNo,
          }  
      }

      // End 


            //   modifying quizzes API

         quizzes.forEach(quiz => {
                if( currentQuestions.filter(currentQuestion => quiz.question_id ==currentQuestion.question_id).length!==0){
                    quiz.visited=true;
                    // delete(quiz.visted);
                }
            
            })  

            //End modifying quizzes API


        const previousQuestionHandler = () => {
            if(currentPage ==1){
                setCurrentPage(1)
                // setPreviousDisabled(true)
            }else{
                setCurrentPage(currentPage - 1)
            }
            
        }

        const nextQuestionHandler = () => {
            if(currentPage < totalQuestions){
                setCurrentPage(currentPage + 1)
            }
            
        }


        const markedQuestionHandler = () => {
                if(attendedQuizzes[currentQuestionId] && attendedQuizzes[currentQuestionId]["answered"] === true){
                    attendedQuizzes[currentQuestionId]["markedAndAnswered"]=true;
                    attendedQuizzes[currentQuestionId]["marked"]=true;
                    nextQuestionHandler();
                }else if(attendedQuizzes[currentQuestionId]){
                    attendedQuizzes[currentQuestionId]["marked"]=true;
                    attendedQuizzes[currentQuestionId]["markedAndAnswered"]=false;
                    nextQuestionHandler();
                }
        }

        //onChange Attended object Handler

        const attendedObjectHandler = (event, question_id, is_correct, index) => { 
            if(Object.keys(attendedQuizzes).includes(`${question_id}`) !== -1){
                if(event.target.checked){
                    attendedQuizzes[question_id] = {
                        ...attendedQuizzes[question_id],
                        question_id,  
                        answer_id: event.target.value, 
                        is_correct,  
                        answered: true,   
                        currentPage,   
                        answer_index : index  
                    }
                    //checking correct answer
                    if(is_correct === true){
                        attendedQuizzes[question_id]["correctlyAnswered"] = true;
                        }else{
                            attendedQuizzes[question_id]["correctlyAnswered"] = false;
                        }
                } else{
                    attendedQuizzes[question_id]["marked"] = false;
                    attendedQuizzes[question_id]["answered"] = false;
                    delete(attendedQuizzes[question_id]["question_id"]);
                    delete(attendedQuizzes[question_id]["answer_id"]);
                    delete(attendedQuizzes[question_id]["is_correct"]);
                    delete(attendedQuizzes[question_id]["answered"]);
                    delete(attendedQuizzes[question_id]["answer_index"]);
                    delete(attendedQuizzes[question_id]["correctlyAnswered"]);
                    delete(attendedQuizzes[question_id]["marked"]);
                    delete(attendedQuizzes[question_id]["markedAndAnswered"]);
                }
            }else{
                attendedQuizzes[currentQuestionId]={
                    ...attendedQuizzes[currentQuestionId],
                    visited: true,
                }  
            }
        }

        //end
    
            

        //SideDrawer Toggler

        const sideDrawerToggleHandler = () => {
        setShowSideDrawer(prevState => !prevState);
        }

        //end


         //BackDrop Toggler

         const backdropHandler = () => {
           if(!showSideDrawer){
               setShowSideDrawer(true);
           }
            }
    
            //end

        let BackDropShow ;
        if(!showSideDrawer){
            BackDropShow = (<Backdrop clicked={backdropHandler}/>)
        }

        //Result Modal Show handler

        const timeOverResultModalHandler = (timerSum) => {
            if(timerSum===0){
                localStorage.setItem("setExamFinish", "true")
            localStorage.getItem("setExamFinish")
            setShowModal(true)
                setTimeoutDisable(true)
                setPreviousDisabled(true)
                setNextDisabled(true)
            }
            if(localStorage.getItem("setExamFinish")){
                setShowModal(true)
                setTimeoutDisable(true)
                setPreviousDisabled(true)
                setNextDisabled(true)
            }
        }

        const resultModalHandler = () => {
            if(localStorage.getItem("setExamFinish")){
            setShowModal(true)
            }else{
                setShowModal(false)
            }
        }

        //End Result Modal Show handler


        const submitMockHandler = () => {
            setShowModal(true)
        }

        let ResultBackdropShow ;
        if(showModal || localStorage.getItem("setExamFinish")){
            ResultBackdropShow = (<ResultBackdrop clicked = {resultModalHandler}/>)
        }


        console.log(attendedQuizzes);

    return (  
    <div className="Test-wrap">
    <Modal
    setShowModal={setShowModal} 
    showModal = {showModal}
    totalQuestions = {quizzes.length}
    attendedQuizzes={attendedQuizzes}   
    quizzes={quizzes}
    />

    <Timer 
    quizTimer={quizTimer}
    timeOverResultModalHandler={timeOverResultModalHandler}
    resultModalHandler={resultModalHandler}
    />
    {ResultBackdropShow}
    {BackDropShow}

    <Sidedrawer
    timeoutDisable={timeoutDisable}
    submitMockHandler={submitMockHandler}
    matches={matches}
    quizzes={quizzes}
    attendedQuizzes={attendedQuizzes}
    currentQuestionId={currentQuestionId}
    totalQuestions={totalQuestions}
     totalAttendedQuestions={totalAttendedQuestions}
     attendedObjectCaller = {attendedObjectCaller}
     paginate={paginate} 
     pageNumbers = {pageNumbers}
     show={showSideDrawer}
    currentPage={currentPage}
        sideDrawerToggleHandler={sideDrawerToggleHandler}
     />
    

    <div style={{background:'#07234d', position: 'relative'}} className={showSideDrawer?"testPageWithSidedrawer Test-content-wrap padding-top-50px padding-bottom-80px":"Test-content-wrap padding-top-50px padding-bottom-80px"}>     
    

 

    <Questioncard 
    show={showSideDrawer}
    currentPage={currentPage} 
    questions={currentQuestions} 
    totalQuestions={totalQuestions} 
    attendedObjectCaller={attendedObjectCaller} 
    />
    <Answers questions={currentQuestions} 
    show={showSideDrawer}
    setCurrentQuestionId={setCurrentQuestionId}
    attendedQuizzes={attendedQuizzes} 
    attendedObjectHandler={attendedObjectHandler}
    />
    <div className="Test-action-nav bg-white py-3">
        <div className="container">
            <div className="row">
                <div style={{marginBottom: 10}} className="col-lg-6">
                   
                        <div className="Test-nav-btns">
                        <button disabled={previousDisabled} onClick={previousQuestionHandler} className='previousButton'><i className="la la-angle-left ml-1"></i>Previous</button>  &nbsp;&nbsp;
                          <button disabled={nextDisabled} onClick={() =>nextQuestionHandler()} className='nextButtons'>Next Question<i className="la la-angle-right ml-1"></i></button> &nbsp;&nbsp;
                        </div>
                    </div>
                    <div className="col-lf-6">
                   <div className="Test-nav-btns">
                   <button disabled={timeoutDisable} style={{backgroundColor:'#6f42c1'}} onClick={markedQuestionHandler} className='nextButtons'>Mark for Review & Next<i className="la la-angle-right ml-1"></i></button>   
                   </div>
               </div>
                </div>
            </div>
        </div>
    </div>
</div>
     );
}

export default Exam;

if (document.getElementById('Exam')) {
    ReactDOM.render(<Exam />, document.getElementById('Exam'));
}

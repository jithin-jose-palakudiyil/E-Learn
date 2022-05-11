import React from 'react';
import './Modal.css';

const Modal = ({showModal, quizzes, totalQuestions,  attendedQuizzes, setShowModal}) => {


     let answered = Object.values(attendedQuizzes).filter(attendedQuiz => attendedQuiz.answered && attendedQuiz.answered === true).length;
    let correctlyAnswered = Object.values(attendedQuizzes).filter(attendedQuiz =>attendedQuiz.answered && attendedQuiz.correctlyAnswered === true).length
    let inCorrectAnswered = Object.values(attendedQuizzes).filter(attendedQuiz => attendedQuiz.correctlyAnswered === false).length
    let marked = Object.values(attendedQuizzes).filter(attendedQuiz =>attendedQuiz.marked && attendedQuiz.marked === true).length
    let NotAnswered = Object.values(attendedQuizzes).filter(attendedQuiz => attendedQuiz.visited === true && !attendedQuiz.answered).length
    let visited = quizzes.filter(quiz =>quiz.hasOwnProperty("visited")).length
    let unVisited = quizzes.length - visited
    let markedAndAnswered = Object.values(attendedQuizzes).filter(attendedQuiz =>attendedQuiz.markedAndAnswered && attendedQuiz.markedAndAnswered === true).length;
    
    const submitHandler = () => {
      localStorage.clear()
    }


    const closeModalHandler = () => {
      setShowModal(false)
    }

    return(
        <div className={(localStorage.getItem("setExamFinish") || showModal)?"Modal Opening":"Modal Closing"}>
            Submit Your Test
            <div className="table-responsive-md">
            <table class="table">
              <thead class="thead-light">
                <tr>
                  <th scope="col">No. of Questions</th>
                  <th scope="col">Answered</th>
                  <th scope="col">Not Answered</th>
                  {localStorage.getItem("setExamFinish")?(<th scope="col">Correct</th>):(<th style={{display:'none'}} scope="col">Correct</th>)}
                  {localStorage.getItem("setExamFinish")?(<th scope="col">Incorrect</th>):(<th style={{display:'none'}} scope="col">Incorrect</th>)}
                  <th scope="col">Marked for Review</th>
                  <th scope="col">Not visted</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">{totalQuestions}</th>
                  <td>{answered}</td>
                  <td>{NotAnswered}</td>
                  {localStorage.getItem("setExamFinish")?(<th scope="col">{correctlyAnswered}</th>):(<th style={{display:'none'}} scope="col">{correctlyAnswered}</th>)}
                  {localStorage.getItem("setExamFinish")?(<th scope="col">{inCorrectAnswered}</th>):(<th style={{display:'none'}} scope="col">{inCorrectAnswered}</th>)}
                  <td>{marked}</td>
                  <td>{unVisited}</td>
                </tr>
              </tbody>
            </table>
            </div>
            <div>
            <button onClick={submitHandler} className='SubmitButton'>Submit</button>
            {!localStorage.getItem("setExamFinish")?(<button onClick={closeModalHandler} className='CloseButton onClick={closeModalHandler}'>Close</button>):(<button style={{display:'none'}} className='CloseButton'>Close</button>)}
            </div>
           
        </div>
    )
}


export default Modal;
import React, { useState } from 'react';
import './Sidedrawer.css'



const SideDrawer = ({show, currentQuestionId, timeoutDisable ,submitMockHandler, sideDrawerToggleHandler,matches,currentPage, paginate, quizzes,attendedQuizzes, totalQuestions ,pageNumbers, totalAttendedQuestions}) => {
 

let answered = Object.values(attendedQuizzes).filter(attendedQuiz => attendedQuiz.answered && attendedQuiz.answered === true).length;
let markedAndAnswered = Object.values(attendedQuizzes).filter(attendedQuiz =>attendedQuiz.markedAndAnswered && attendedQuiz.markedAndAnswered === true).length;
let marked = Object.values(attendedQuizzes).filter(attendedQuiz =>attendedQuiz.marked && attendedQuiz.marked === true).length
let NotAnswered = Object.values(attendedQuizzes).filter(attendedQuiz => attendedQuiz.visited === true && !attendedQuiz.answered).length
let visited = quizzes.filter(quiz =>quiz.hasOwnProperty("visited")).length
let unVisited = quizzes.length - visited


// console.log(marked);
// console.log(attendedQuizzes);

    return (
        // <nav className={show && matches? "Sidedrawer Open" : "Sidedrawer Close"}>
        <nav className={matches? (show ? "Sidedrawer Open" : "Sidedrawer Close") : (show ? "Sidedrawer Close" : "Sidedrawer Open")}>
            
            <table className="colorPaletteTable">
                <tr>
                <td><div style={{ backgroundColor: 'cadetblue'}} >{answered}</div>Answered</td>
                    <td><div style={{ backgroundColor: 'brown'}} >{NotAnswered}</div>Not Answered</td>
                </tr>
                <tr>
                  <td><div style={{ backgroundColor: 'darkorchid'}} >{marked}</div>Marked</td>
                  <td><div style={{ backgroundColor: '#432750'}} >{markedAndAnswered}</div>Marked & Answered</td>
                </tr>
                <tr>
                <td><div style={{ color:'black', backgroundColor: 'rgb(205 205 205)'}} >{unVisited}</div>Not Visited</td>
                </tr>
            </table>
        
             <div style={{marginTop:35}}>
        <div style={{position:'relative'}} className="container">
        <i onClick={sideDrawerToggleHandler} className={matches?(show?"arrowButtonOpened la la-angle-right ml-1":"arrowButtonClosed la la-angle-left ml-1"):
(show?"arrowButtonClosed la la-angle-left ml-1":"arrowButtonOpened la la-angle-right ml-1")}></i>  
        <div className="QuestionPallettes">
                 {pageNumbers.map((number) => {
                
                let key; 
                    let assignedClasses = ["Boxes"];
                    if(currentPage===number){
                        assignedClasses.push("BoxesActive")
                    }else if(key = Object.keys(attendedQuizzes).find(k => attendedQuizzes[k].currentPage == number)){
                        if(attendedQuizzes[key].answered === true && !attendedQuizzes[key].markedAndAnswered){
                            assignedClasses.push("Answered")
                        }else if(attendedQuizzes[key].marked === true && !attendedQuizzes[key].answered){
                            assignedClasses.push("Marked")
                        }else if(attendedQuizzes[key].markedAndAnswered && attendedQuizzes[key].markedAndAnswered === true && attendedQuizzes[key].answered === true){
                            assignedClasses.push("MarkedAndAnswered")
                        }
                        else{
                            assignedClasses.push("NotAnswered")
                        }
                    }
                    
                    return(
                        <button disabled={timeoutDisable} className={assignedClasses.join(" ")} key={number} onClick={ () => paginate(number)}>
                         <p>{number}</p>
                     </button> 
                    )
                }
             )}
                </div>
             </div>
        </div>
               
             <div>
             <button onClick={submitMockHandler} className='SubmitMockButton'>Submit</button> 
             </div>
        </nav>
    )
}

                
export default SideDrawer;  



                    //    let q;
                    //  let key;
                    //  let assignedClasses=["Boxes"]
                    //  if(currentPage === number){
                    //      assignedClasses.push("BoxesActive")
                    //  }else if(q = marked.find(mark => mark.currentPage == number)){
                    //      if(attendedQuizzes[q.question_id] && attendedQuizzes[q.question_id].answered === true){
                    //         assignedClasses.push("MarkedAndAnswered")
                    //      }else{
                    //          assignedClasses.push("Marked")
                    //      }
                    //  }else if(key = Object.keys(attendedQuizzes).find(k => attendedQuizzes[k].currentPage == number)){
                    //      if(attendedQuizzes[key].answered === true){
                    //         assignedClasses.push("Answered")
                    //      }else{
                    //          assignedClasses.push("NotAnswered")
                    //      }
                    //  } 
import React,{useEffect, useState} from 'react';
import Questioncard from '../QuestionCard/QuestionCard'
import Answers from '../Answers/Answers'

//API
import quizzies from '../../api/quizzies';


const Layout = (props) => {

    const [quizzes, setQuizzes] = useState([]);
    const [index, setIndex] = useState(0);
  

    useEffect(() => {
        const fetchQuiz = async () => {
          const response = await quizzies.get('/example');
          const result = await response.data;
          setQuizzes(result);
//           console.log(result[0].question);
         
        //   setLoading(false);
        };
        fetchQuiz();
      }, [setQuizzes]);
    
    
//   console.log(quizzes);

      return(
        <div>
            <Questioncard questions={quizzes} index={index}/>
                {props.children}
            <Answers questions={quizzes} index={index}/>
        </div>
    )
}

export default Layout
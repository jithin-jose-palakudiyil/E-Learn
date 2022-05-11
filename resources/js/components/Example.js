import React,{useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import quiz from '../api/quizzies';

const Example = () => {

    const [quizzes, setQuizzes] = useState();

    useEffect(() => {
        const fetchQuiz = async () => {
          const response = await quiz.get('/example');
          const result = await response.data;
          setQuizzes(result);
         console.log(result[1].question);
        //   setLoading(false);
        };
        fetchQuiz();
      }, [setQuizzes]);



    return (
        <div style={{margin:100}}>
            <h1>Test Example Component</h1>
        </div>
    );
}

export default Example;

if (document.getElementById('Example')) {
    ReactDOM.render(<Example />, document.getElementById('Example'));
}

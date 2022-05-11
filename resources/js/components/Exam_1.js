//React
import React from 'react';
import ReactDOM from 'react-dom';

//Components
import Layout from './Layout/Layout';

//CSS
import './Exam.css'

const Exam = () => {


    return (  
    <div className="Test-wrap">
    <div style={{background:'#07234d', position: 'relative'}} className="Test-content-wrap padding-top-60px padding-bottom-60px">  
    <div className="col-lg-6 countBox">

{
/* <div className="attendedContainer">
    <p>Correct    <div style="height: 25px; width: 25px; background-color: cadetblue; "></div></p>
    <p>Incorrect    <div style="height: 25px; width: 25px; background-color:brown; "></div></p>
</div>

<div className="attendedContainer">
    <p>Attempted<div style="height: 25px; width: 25px; background-color: darkorchid; "></div></p>
    <p>Not Attempted<div style="height: 25px; width: 25px; background-color: #f5f5f5; "></div></p>
</div> */
        }


<div style={{marginTop:35}}>

<div className="QuestionPallette">
   <div><p>1</p></div> 
   <div><p>2</p></div> 
    <div><p>3</p></div>
   <div><p>4</p></div> 
   <div><p>5</p></div> 
   <div><p>6</p></div> 
   <div><p>7</p></div> 
   <div><p>8</p></div> 
   <div><p>9</p></div> 
    <div><p>10</p></div>

</div>
<div className="QuestionPallette">
   <div><p>11</p></div> 
    <div><p>12</p></div>
   <div><p>13</p></div> 
   <div><p>14</p></div> 
   <div><p>15</p></div> 
   <div><p>16</p></div> 
   <div><p>17</p></div> 
   <div><p>18</p></div> 
   <div><p>19</p></div> 
   <div><p>20</p></div> 

</div>

<div className="QuestionPallette">
   <div><p>21</p></div> 
   <div><p>22</p></div> 
   <div><p>23</p></div> 
   <div><p>24</p></div> 
   <div><p>25</p></div> 
   <div><p>26</p></div> 
   <div><p>27</p></div> 
   <div><p>28</p></div> 
   <div><p>29</p></div> 
   <div><p>30</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>31</p></div>  
    <div><p>32</p></div> 
    <div><p>33</p></div> 
    <div><p>34</p></div> 
    <div><p>35</p></div> 
    <div><p>36</p></div> 
    <div><p>37</p></div> 
    <div><p>38</p></div> 
    <div><p>39</p></div> 
    <div><p>40</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>41</p></div>  
    <div><p>42</p></div> 
    <div><p>43</p></div> 
    <div><p>44</p></div> 
    <div><p>45</p></div> 
    <div><p>46</p></div>  
    <div><p>47</p></div> 
    <div><p>48</p></div> 
    <div><p>49</p></div> 
    <div><p>50</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>51</p></div> 
    <div><p>52</p></div> 
    <div><p>53</p></div> 
    <div><p>54</p></div> 
    <div><p>55</p></div> 
    <div><p>56</p></div> 
    <div><p>57</p></div> 
    <div><p>58</p></div> 
    <div><p>59</p></div> 
    <div><p>60</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>61</p></div> 
    <div><p>62</p></div>
    <div><p>63</p></div>  
    <div><p>64</p></div> 
    <div> <p>65</p></div>
    <div><p>66</p></div> 
    <div><p>67</p></div> 
    <div><p>68</p></div> 
    <div><p>69</p></div> 
    <div><p>70</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>71</p></div>   
    <div><p>72</p></div> 
    <div><p>73</p></div> 
    <div><p>74</p></div> 
    <div><p>75</p></div> 
    <div><p>76</p></div> 
    <div><p>77</p></div> 
    <div><p>78</p></div> 
    <div><p>79</p></div> 
    <div><p>80</p></div> 

</div>

<div className="QuestionPallette">
    <div><p>81</p></div>
   <div><p>82</p></div> 
    <div><p>83</p></div>
    <div><p>84</p></div>
    <div><p>85</p></div>
    <div><p>86</p></div>
    <div><p>87</p></div>
    <div><p>88</p></div>
    <div><p>89</p></div>
   <div><p>90</p></div> 

</div>

<div className="QuestionPallette">
   <div><p>91</p></div> 
  <div><p>92</p></div>  
   <div><p>93</p></div> 
    <div><p>94</p></div>
   <div><p>95</p></div> 
   <div><p>96</p></div> 
    <div><p>97</p></div>
   <div><p>98</p></div> 
   <div><p>99</p></div> 
   <div><p>100</p></div> 

</div>

</div>





    <div className="actions">
        <a href="student-Test-result-details.html" className="theme-btn theme-btn-light mr-2">Skip Test</a>
        <a href="student-Test-result-details.html" className="theme-btn theme-btn-light bg-color-1 text-white">Next Question <i className="la la-angle-right ml-1"></i></a>  
    </div>


</div>

<Layout>
    <div className="Test-action-nav bg-white py-3">
        <div className="container">
            <div className="row">
                <div className="col-lg-6">
                    <div className="Test-action-content d-flex align-items-center justify-content-between">
                        <ul className="Test-nav d-flex align-items-center">
                            <li><i className="la la-sliders font-size-20 mr-2"></i>Choose the correct answer below</li>
                        </ul>
                    </div>
                        <div className="Test-nav-btns">
                            <a href=" student-Test-result-details.html" className="skipButton theme-btn theme-btn-light mr-2">Skip Test</a>
                            <a href=" student-Test-result-details.html" className="nextButton theme-btn theme-btn-light bg-color-1 text-white">Next Question <i className="la la-angle-right ml-1"></i></a>  
                            <a href="#" className="theme-btn theme-btn-light mr-2">Case Study</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
    </div>
</div>
     );
}

export default Exam;

if (document.getElementById('Exam')) {
    ReactDOM.render(<Exam />, document.getElementById('Exam'));
}

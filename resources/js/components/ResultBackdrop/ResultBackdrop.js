import React from 'react';
import './ResultBackdrop.css';

const ResultBackdrop = ({clicked}) => {
    return(
        <div onClick={clicked} className="ResultBackdrop"></div>
    )
}

export default ResultBackdrop;
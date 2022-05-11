import React from 'react';
import './Backdrop.css';

const BackDrop = ({clicked}) => {
    return(
        <div onClick={clicked} className="Backdrop"></div>
    )
}

export default BackDrop;
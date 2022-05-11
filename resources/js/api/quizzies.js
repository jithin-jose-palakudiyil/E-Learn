
import axios from 'axios';

const instance = axios.create({
    baseURL: base_url 
});

export default instance;
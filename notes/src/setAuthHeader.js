import axios from "axios";

const setAuthHeder = (token) => {
    if(token)
    {
        axios.defaults.headers = {
            Authorization: "Bearer " + token,
            // 'Content-Type': application/json,
        };
    }
    else
    {
        delete axios.defaults.headers.Authorization;
    }
}

export default setAuthHeder;
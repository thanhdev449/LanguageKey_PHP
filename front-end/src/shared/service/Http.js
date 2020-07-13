import axios from "axios";
//import environment from "../../environments/environments";

const baseURL = "https://localhost:8080/api";
// /const baseUrl = environment.baseURL;

export default axios.create({
    baseURL
    // headers
});

import axios from "axios";
import environment from "./../../environments/environments";

const apiUrl = environment.host;
const baseUrl = environment.baseURL;

export default axios.create({
    apiUrl
});

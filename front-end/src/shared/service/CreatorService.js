import Http from "./Http";

const resource = "creator";

export default {
    listandFindCreator(params) {
        return Http.get(`${resource}/list?email=${params.email}&full_name=${params.fullName}&country=${params.country}&page_limit=${params.pageLimit}`);
    }
};

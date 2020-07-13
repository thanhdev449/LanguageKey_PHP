import CreatorService from "./CreatorService";

const ResfulServices = {
    creator: CreatorService
};

export const ResfullServiceFactory = {
    get: name => ResfulServices[name]
};

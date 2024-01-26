import Request from "@/plugins/request";

export function login(email : string, password : string) : Promise<any>{
    return Request({
        url: "login",
        method: "POST",
        data: {email, password}
    })
}
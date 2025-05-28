import Request from "@/plugins/request";

export function login(email : string, password : string) : Promise<any>{
    return Request({
        url: "login",
        method: "POST",
        data: {email, password}
    })
}

export function logout() : Promise<any>{
    return Request({
        url: "logout",
        method: "POST",
    })
}

export function me() : Promise<any>{
    return Request({
        url: "api/user",
        method: "GET",
    })
}


export function getCsrf() : Promise<any>{
    return Request({
        url: 'sanctum/csrf-cookie',
        method: "GET"
    })
}
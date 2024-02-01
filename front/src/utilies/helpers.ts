export function backendLink(url: string) : string{
    return process.env.VUE_APP_API_URL + url;

}
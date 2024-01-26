export function required(v : any){
    return !!v || 'This element is required';
}

export function email(v : any){
    if(!v) return true;
    v = v.replace(/\s/g, "");
    if((v.match(new RegExp("@", "g")) || []).length > 1){
        return 'E-mail must be valid';
    }
    return v && /.+@.+\..+/.test(v) || 'E-mail must be valid';
}
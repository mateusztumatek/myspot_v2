import {$t} from "@/plugins/i18n";

export function required(v : any){
    return !!v || $t('validations.element_required');
}

export function email(v : any){
    if(!v) return true;
    v = v.replace(/\s/g, "");
    if((v.match(new RegExp("@", "g")) || []).length > 1){
        return 'E-mail must be valid';
    }
    return v && /.+@.+\..+/.test(v) || $t('validations.email_not_valid');
}
export interface LaravelResourcePaginated<t>{
    data: t[];
    links:{
        first: string;
        last: string;
        prev?: string;
        next?: string;
    };
    meta:{
        current_page: number;
        last_page: number;
        per_page: number;
        total: number;
        from: number;
        to: number;
    }
}
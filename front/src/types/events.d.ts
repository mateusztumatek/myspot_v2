export interface EventInterface {
    id: string;
    uuid: string,
    name: string,
    description: ?string,
    category_id: ?number,
    category?: EventCategoryInterface
    location_name: string,
    location_latitude: ?number,
    location_longitude: ?number,
    start_at: string;
    end_at: Date | string;
    visibility: EventVisibility,
    max_attendees: ?number,
    sign_up_until: ?string,
    user_visibility: UserVisibility,
    paid: boolean,
    payment_details: EventPaymentDetailsInterface,
    created_at: string,
    updated_at: string,
}

export type EventVisibility = 'public' | 'private';

export type UserVisibility = 'visible_each_other' | 'visible_to_admin';

export interface EventCategoryInterface {
    id: id,
    name: string
}

export interface EventPaymentDetailsInterface {
    // @todo: define payment details structure
}
export interface Event {
    id: string;
    uuid: string,
    name: string,
    description: ?string,
    category_id: ?number,
    category?: EventCategory
    start_at: string;
    ends_at: Date | string;
    allDay?: boolean;
    location?: string;
    url?: string;
    createdAt?: Date | string;
    updatedAt?: Date | string;
    userId?: string; // Optional, if the event is associated with a user
}

export interface EventCategory {
    id: id,
    name: string
}
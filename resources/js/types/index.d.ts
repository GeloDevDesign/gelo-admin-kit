export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at?: string;
    roles?: Role[];
    avatar?: string;
}

export interface Role {
    id: number;
    name: string;
    label?: string;
}

export interface MenuItem {
    label: string;
    icon?: any;
    toolTipName?: string;
    children?: MenuItem[];
    isOpen?: boolean;
    routeName?: string;
    route?: string ;
}

export interface MenuSection {
    title?: string;
    items: MenuItem[];
}

export interface LinkItem {
    url: string | null;
    label: string;
    active: boolean;
}

export interface PaginationData<T = any> {
    data: T[];
    current_page: number;
    last_page: number;
    links: LinkItem[];
    total: number;
    next_page_url?: string | null;
    prev_page_url?: string | null;
    from?: number;
    to?: number;
}


export type PageProps<
    T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
    auth: {
        user: User;
    };
};

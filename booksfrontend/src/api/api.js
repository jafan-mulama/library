// api.js
import axios from 'axios';
/** to use it import {logout} from "@/api/api"; **/
export const logout = async () => {
    try {
        const response = await axios.post('/api/logout', null, {
            headers: {
                'Authorization': `Bearer ${localStorage.getItem('token')}`,
            },
        });

        if (response.status === 200) {
            localStorage.removeItem('token');
            return true;
        } else {
            console.error('Logout failed');
            return false;
        }
    } catch (error) {
        console.error('Logout error:', error);
        return false;
    }
};

/**  // alternative method handling the navigation guard logic for admin  user
//
export const isAdmin = () => {
    const userRole = localStorage.getItem('userRole');
    return userRole === 'admin';
};

export const requireAdmin = (to, from, next) => {
    if (isAdmin()) {
        next(); // Allow access
    } else {
        // Redirect to a different route or show an error message
        next('/login'); // Redirect to the home page, for example
    }
};
 **/

/**  handling the navigation guard logic for admin and normal user  by resusing Api **/
export const getUserRole = () => {
    return localStorage.getItem('userRole');
};

export const requireUserRole = (requiredRole) => {
    return (to, from, next) => {
        const userRole = getUserRole();
        // Check if the user is authenticated and has the required role
        if (userRole === requiredRole) {
            next(); // Allow access
        } else {
            // Redirect to a different route or show an error message
            next('/login'); // Redirect to the home page, for example
        }
    };
};




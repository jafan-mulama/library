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
/** end of logout function **/

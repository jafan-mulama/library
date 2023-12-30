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


// Fetch user ID from the server
export async function fetchUserId() {
    try {
        // Retrieve the user ID from the authentication state
        const userId = localStorage.getItem('userId'); // Adjust the storage key as needed

        if (!userId) {
            throw new Error('User ID not found in the local storage.');
        }

        const response = await axios.get(`/api/users/${userId}`); // Adjust the endpoint as needed
        return response.data.user.id;
    } catch (error) {
        console.error('Error fetching user ID:', error);
        throw error; // Propagate the error to the calling function
    }
}

// Fetch user details for the currently authenticated user
export async function fetchCurrentUserDetails() {
    try {
        const userId = localStorage.getItem('userId'); // Adjust the storage key as needed

        if (!userId) {
            throw new Error('User ID not found in the local storage.');
        }

        const response = await axios.get(`/api/users/${userId}`); // Adjust the endpoint as needed
        return response.data; // Adjust the response structure based on your API
    } catch (error) {
        console.error('Error fetching current user details:', error);
        throw error;
    }
}


const BASE_URL = '/api'; // Adjust the base URL as needed

// Function to fetch books
export const fetchBooks = () => {
    return axios.get(`${BASE_URL}/books`)
        .then(response => response.data.books)
        .catch(error => {
            console.error('Error fetching books:', error);
            throw error; // Propagate the error to the calling function
        });
};

// Function to fetch a book by ID
export const getBookById = (bookId) => {
    return axios.get(`${BASE_URL}/books/${bookId}`)
        .then(response => response.data.book)
        .catch(error => {
            console.error(`Error fetching book with ID ${bookId}:`, error);
            throw error;
        });
};

// Function to update a book
export const updateBook = (bookId, updatedBook) => {
    return axios.put(`${BASE_URL}/books/${bookId}`, updatedBook)
        .then(response => response.data)
        .catch(error => {
            console.error('Error updating book:', error);
            throw error;
        });
};


// Function to delete a book
export const deleteBook = (bookId) => {
    console.log('Deleting book with ID:', bookId);
    const confirmed = window.confirm('Are you sure you want to delete this book?');

    if (!confirmed) {
        return Promise.resolve(); // Resolve the promise without doing anything if not confirmed
    }

    return axios.delete(`${BASE_URL}/books/${bookId}}`)
        .then(() => {
            console.log('Book deleted successfully');
        })
        .catch(error => {
            console.error('Error deleting book:', error);
            throw error; // Propagate the error to the calling function
        });
};

// Function to edit a book







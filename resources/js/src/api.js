const axios = window.axios;

const BASE_API_URL = 'http://127.0.0.1:8080/api'

export default {
    getAllHobbies: () =>
    axios.get(`${BASE_API_URL}/hobbies`),
    getOneHobby: (id) =>
    axios.get(`${BASE_API_URL}/hobbies/${id}/edit`),
    updateHobby: (hobby, id) =>
    axios.put(`${BASE_API_URL}/hobbies/${id}`, hobby),
    deleteHobby: (id) =>
    axios.delete(`${BASE_API_URL}/hobbies/delete/${id}`)
}

import { File } from "../dtos/file";
import axios from "axios";

const API_URL = "http://localhost:8000";

async function getFiles(): Promise<File[]> {
  const data = await axios.get(`${API_URL}/file`)
    .then(response => {
      return response.data;
    });

  return data;
}

async function uploadFile(formData: FormData) {
  const data = axios({
    url: `${API_URL}/ticket`,
    method: "POST",
    headers: {
      'Content-Type': 'multipart/form-data'
    },
    data: formData
  }).then(response => {
    return response.data;
  }).catch(function (error) {
    return error.toJSON();
  });

  return data;
}

export { getFiles, uploadFile };

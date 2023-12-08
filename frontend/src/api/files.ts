import { File } from "../dtos/file";
import axios from "axios";

async function getFiles(): Promise<File[]> {
    const data = await axios.get('http://localhost:8000/')
        .then(response => {
            return response.data;
        });

    return data;
}

export default getFiles;

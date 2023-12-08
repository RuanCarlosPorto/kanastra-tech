import { FileActionType } from "@/constants";
import { useFileContext } from "@/context";
import { ChangeEvent } from "react";

import { uploadFile } from "@/api/files";
import { Loader } from "@/components/Loader";

const SingleFileUploader = () => {
  const { state: { file, isLoading }, dispatch } = useFileContext();

  const handleFileChange = (e: ChangeEvent<HTMLInputElement>) => {
    if (e.target.files) {
      dispatch({
        type: FileActionType.SET_UPLOAD_FILE,
        payload: {
          file: e.target.files[0],
        }
      });
    }
  };

  const handleUpload = async () => {
    if (!file) {
      return;
    }

    dispatch({
      type: FileActionType.SET_IS_LOADING,
      payload: {
        isLoading: true
      }
    });

    const formData = new FormData();
    formData.append('input', file);

    const data = await uploadFile(formData);

    if (data) {
      dispatch({
        type: FileActionType.SET_IS_LOADING,
        payload: {
          isLoading: false
        }
      });
    }
  };

  return (
    <>
      {isLoading && <Loader/>}
      <div className = "flex flex-col gap-6">
        <div>
          <label htmlFor="file" className="sr-only">
            Choose a file
          </label>
          <input id="file" type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv" onChange={handleFileChange} />
        </div>
        {file && (
          <section>
            <p className="pb-6">File details:</p>
            <ul>
              <li>Name: {file.name}</li>
              <li>Type: {file.type}</li>
              <li>Size: {file.size} bytes</li>
            </ul>
          </section>
        )}

        {file && <button className="rounded-lg bg-green-800 text-white px-4 py-2 border-none font-semibold" onClick={handleUpload}>Upload the file</button>}
      </div>
    </>
  );
};

export { SingleFileUploader };

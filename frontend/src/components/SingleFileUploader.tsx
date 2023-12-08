import { FileActionType } from "@/constants";
import { useFileContext } from "@/context";
import { ChangeEvent, useEffect } from "react";

const SingleFileUploader = () => {
  const { state: { file }, dispatch } = useFileContext();

  const handleFileChange = (e: ChangeEvent<HTMLInputElement>) => {
    if (e.target.files?.length) {
      dispatch({
        type: FileActionType.SET_UPLOAD_FILE,
        payload: {
          file: e.target.files[0],
        }
      })
    }
  };

  const handleUpload = async () => {
    // Do your upload logic here. Remember to use the FileContext
  };

  return (
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
  );
};

export { SingleFileUploader };

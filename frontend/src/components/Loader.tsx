import { ReactElement } from "react";

function Loader(): ReactElement {
  return (
    <div className="loader">
      <div className="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    </div>
  );
}

export { Loader }
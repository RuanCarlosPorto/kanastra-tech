import { ReactElement } from "react";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/components/ui/table"
import { useFileContext } from "@/context";

function FileList(): ReactElement {
  const { state: { fileList } } = useFileContext();
    return (
      <>
        <h1 className="text-2xl font-bold pt-5 text-green-800">File List</h1>

        <Table>
          <TableCaption>A list of uploaded files.</TableCaption>
          <TableHeader>
            <TableRow>
              <TableHead className="w-[100px]">Id</TableHead>
              <TableHead>File Name</TableHead>
              <TableHead>Size (bytes)</TableHead>
              <TableHead className="text-right">Uploaded At</TableHead>
            </TableRow>
          </TableHeader>
          <TableBody>
            {(fileList ? fileList : []).map((item) => (
            <TableRow>
              <TableCell className="font-medium">{item.id}</TableCell>
              <TableCell>{item.name}</TableCell>
              <TableCell>{item.size}</TableCell>
              <TableCell className="text-right">{new Date(item.created_at).toLocaleString()}</TableCell>
            </TableRow>
            ))}
          </TableBody>
        </Table>
      </>
    )
}

export { FileList };

import { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";
import { motion } from "framer-motion";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Skeleton } from "@/components/ui/skeleton";

interface WorkItem {
  id: number;
  title: string;
  description: string;
  slug: string;
  image?: string;
  tags?: string[];
}

export default function Work() {
  const [works, setWorks] = useState<WorkItem[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    axios.get("http://127.0.0.1:8000/api/works")
      .then((res) => setWorks(res.data))
      .catch((err) => console.error("Failed to fetch works:", err))
      .finally(() => setLoading(false));
  }, []);

  const skeletonArray = Array(6).fill(null);

  return (
    <div className="min-h-screen bg-white dark:bg-[#0D0D0D] py-20 px-4 md:px-12 lg:px-20">
      <div className="max-w-6xl mx-auto">
        <motion.h2
          className="text-3xl md:text-4xl font-bold mb-12 text-center"
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6 }}
        >
          My Work & Projects
        </motion.h2>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          {loading
            ? skeletonArray.map((_, i) => (
                <Card key={i} className="h-full flex flex-col shadow-md border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#111]">
                  <Skeleton className="w-full h-48 rounded-t-md" />
                  <CardHeader>
                    <Skeleton className="h-6 w-3/4" />
                  </CardHeader>
                  <CardContent className="flex-1 flex flex-col gap-2">
                    <Skeleton className="h-4 w-full" />
                    <Skeleton className="h-4 w-5/6" />
                    <Skeleton className="h-4 w-2/3" />
                    <Skeleton className="h-6 w-1/3 mt-4" />
                  </CardContent>
                </Card>
              ))
            : works.map((work, index) => (
                <motion.div
                  key={work.id}
                  initial={{ opacity: 0, y: 40 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: index * 0.1 }}
                >
                  <Card className="h-full flex flex-col shadow-md border border-gray-200 dark:border-gray-800 bg-white dark:bg-[#111] hover:shadow-lg transition">
                    {work.image && (
                      <img
                        src={`http://127.0.0.1:8000/storage/${work.image}`}
                        alt={work.title}
                        className="w-full h-48 object-cover rounded-t-md"
                      />
                    )}
                    <CardHeader>
                      <CardTitle className="text-lg font-semibold">
                        {work.title}
                      </CardTitle>
                    </CardHeader>
                    <CardContent className="flex-1 flex flex-col">
                      <p className="text-sm text-muted-foreground line-clamp-3 mb-4">
                        {work.description}
                      </p>

                      {work.tags && work.tags.length > 0 && (
                        <div className="flex flex-wrap gap-2 mb-4">
                          {work.tags.map((tag, i) => (
                            <Badge key={i} className="text-xs" variant="outline">
                              {tag}
                            </Badge>
                          ))}
                        </div>
                      )}

                      <Link
                        to={`/work/${work.slug ?? work.id}`}
                        className="mt-auto text-sm font-medium text-blue-600 hover:underline hover:text-blue-700 transition-colors"
                      >
                        Learn More →
                      </Link>
                    </CardContent>
                  </Card>
                </motion.div>
              ))}
        </div>
      </div>
    </div>
  );
}
